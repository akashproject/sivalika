<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ReservedRooms;
use App\Models\HotelRoom;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Payment;
use Image;

class BookingController extends Controller
{
    public $_statusOK = 200;
    public $_statusErr = 500;
    private $userData;

    public function __construct()
    {
       
    }

    public function index() {
        try {

            $bookings = DB::table('bookings')
                            ->join('customers', 'bookings.user_id', '=', 'customers.id')
                            ->join('hotels', 'bookings.hotel_id', '=', 'hotels.id')
                            ->select('bookings.id','hotels.name as hotel','bookings.booking_id','bookings.user_id','customers.name','customers.mobile','bookings.amount','bookings.payment','bookings.status');
            
            //$checkin = date("Y-m-d");
            if(request()->has('cust_id')){
                $bookings->where('user_id', request()->get('cust_id'));
            }

            if(Auth::user()->role == 2){
                $bookings->where('hotel_id', get_user_meta('hotel_id'));
            }
            
            if(request()->has('checkin')){
                $checkin = request()->get('checkin');
                $bookings->whereDate('checkin', $checkin);
            }
            
            $bookings = $bookings->orderBy('id', 'DESC')->get();
            return view('bookings.index',compact('bookings'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }        
    }

    public function checkAvailability(Request $request){
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'checkin' => 'required',
                'checkout' => 'required',
            ]);
            unset($data['_token']);
            $request->session()->put('filterData', $data);

            return redirect()->back();
            //$booking = Booking::select('id')->where

        } catch(\Illuminate\Database\QueryException $e){
        }
    }

    public function add(Request $request) {
        try {
            $hotels = Hotel::all();

            $filterData = [
                'checkin'=>date('Y-m-d'),
                'checkout'=>date('Y-m-d', strtotime(' +1 day')),
                'total_guest'=>1,
            ];

            if($request->session()->has('filterData')) {
                $filterData = $request->session()->get('filterData');
            }

            $checkinTime = $filterData['checkin'].config('constant.checkinTime');
            $checkoutTime = $filterData['checkout'].config('constant.checkoutTime');

            return view('bookings.add',compact('filterData','hotels'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function createBooking(Request $request){
        try {
            $hotel = Hotel::where('id',get_user_meta('hotel_id'))->first();
            
            $filterData = [
                'checkin'=>date('Y-m-d'),
                'checkout'=>date('Y-m-d', strtotime(' +1 day')),
                'total_guest'=>1,
            ];

            if($request->session()->has('filterData')) {
                $filterData = $request->session()->get('filterData');
            }

            $checkinTime = $filterData['checkin'].config('constant.checkinTime');
            $checkoutTime = $filterData['checkout'].config('constant.checkoutTime');
            
            $todayBooking = Booking::select('id')->where('bookings.hotel_id',get_user_meta('hotel_id'))->where('bookings.checkout','>',$checkinTime)->where('bookings.checkin','<',$checkoutTime)->get();
            $rooms = Room::where("hotel_id",$hotel->id)->get();
            $bookedRoom = array();
            if ($todayBooking->count() > 0) {
                //SELECT `reserved_rooms`.`room_id`, SUM(`reserved_rooms`.`total_room_book`) as `roomstakes` FROM `bookings` join `reserved_rooms` on `reserved_rooms`.`booking_id` = `bookings`.`id` WHERE `bookings`.`hotel_id` AND `checkin` < '2023-07-20 12:24:30' AND `checkout` > '2023-07-20 12:24:30' GROUP by `reserved_rooms`.`room_id`;
                $bookedRoom = DB::table('bookings')
                ->join('reserved_rooms', 'reserved_rooms.booking_id', '=', 'bookings.id')
                ->join('rooms', 'reserved_rooms.room_id', '=', 'rooms.id')
                ->select('reserved_rooms.room_id')
                ->selectRaw('sum(reserved_rooms.total_room_book) as roomstake')              
                ->whereIn('bookings.id',$todayBooking)
                ->where('bookings.hotel_id',get_user_meta('hotel_id'))
                ->where('bookings.status','!=','cancel')
                ->groupBy('reserved_rooms.room_id')
                ->get();
            } else {
                $rooms = Room::where("hotel_id",$hotel->id)->get();
            }
            return view('bookings.addFromFrontDesk',compact('hotel','rooms','filterData','bookedRoom'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function show($id,Request $request) {
        try {
            
            $hotels = Hotel::all();
            if(get_user_meta('hotel_id')){
                $hotels = Hotel::where('id',get_user_meta('hotel_id'))->get();
            }
            
            $booking = DB::table('bookings')
            ->join('customers', 'bookings.user_id', '=', 'customers.id')
            ->select('bookings.*','customers.*','bookings.status as bookingStatus','bookings.id as bookingId','customers.id as customerId')
            ->where('bookings.id', $id)->first();

            if($booking == null) return redirect()->route('bookings')->with('message', 'No Record found');
            
            $booking->rooms = (isset($booking->rooms))?json_decode($booking->rooms,true):"";
            
            $filterData = [
                'checkin'=> date("Y-m-d",strtotime($booking->checkin)),
                'checkout'=> date("Y-m-d",strtotime($booking->checkout)),
                'total_guest'=> $booking->total_guest,
            ];

            if($request->session()->has('filterData')) {
                $filterData = $request->session()->get('filterData');
            }
            
            $todayBooking = Booking::where('bookings.checkout','>',$filterData['checkin'])->where('bookings.checkin','<',$filterData['checkout'])->count();

            $rooms = Room::where("hotel_id",$booking->hotel_id)->get();

            return view('bookings.show',compact('booking','rooms','hotels','filterData'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function addGuests($booking_id,Request $request){
        try {
            $booking = Booking::find($booking_id); 
            if($booking == null) return redirect()->route('bookings')->with('message', 'No Record found');
            if($booking->status != 'arrvied') return redirect()->route('view-booking',['id'=>$booking_id])->with('message', 'Customer not CHECK IN yet');

            $guestData = json_decode(get_booking_meta($booking_id,'guest'),true);        
            $guestCount = (isset($booking))?$booking->total_guest:$filterData['total_guest']; 

            if($guestData == null) {
                $guests = [];
                for ($i=0; $i < $guestCount; $i++) { 
                    $guests[$i] = [
                        'name'=>'','dob'=>'','gender'=>'','address'=>'','city'=>'','state'=>'','pincode'=>'','nationality'=>'','identity_type'=>'','identity'=>'','identity_image'=>'',
                    ];
                }
            } else {
                for ($i=0; $i < $guestCount; $i++) { 
                    $guests[$i] = $guestData[$i];
                }
            }
            
            return view('bookings.addGuests',compact('guests','booking_id'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function allocateRooms($booking_id,Request $request){
        try {
            $booking = Booking::find($booking_id);    
            if($booking == null) return redirect()->route('bookings')->with('message', 'No Record found');
            if($booking->status != 'arrvied') return redirect()->route('view-booking',['id'=>$booking_id])->with('message', 'Customer not CHECK IN yet');
            $rooms = json_decode(get_booking_meta($booking_id,'room'),true);    
            
            $checkinTime = $booking->checkin; // request()->get('checkin').config('constant.checkinTime');
            $checkoutTime = $booking->checkout; //date('Y-m-d', strtotime(request()->get('checkin').' +1 day')).config('constant.checkoutTime');
           
            $todayBooking = DB::table('bookings')
                            ->join('booking_meta', 'bookings.id', '=', 'booking_meta.booking_id')
                            ->join('customers', 'customers.id', '=', 'bookings.user_id')
                            ->where('bookings.checkout','>',$checkinTime)
                            ->where('bookings.checkin','<',$checkoutTime)
                            ->where('booking_meta.meta_key','room')
                            ->where('bookings.id', '!=' , $booking_id)
                            ->select('booking_meta.meta_value as rooms','booking_meta.booking_id','customers.name')
                            ->get();
            $reservedRooms = array();
            foreach ($todayBooking as $value) {
                foreach (json_decode($value->rooms,true) as $room) {
                    $reservedRooms[$room]['name'] = $value->name;
                }
            }

            $roomType = array();
            foreach(json_decode($booking->rooms,true) as $key => $value) {
                if ($value) {
                    $roomType[] = $key;
                }
            }
                        
            $hotelRooms = HotelRoom::where("hotel_id",$booking->hotel_id)
                    ->whereIn('room_id',$roomType)
                    ->where('status','!=','blocked')
                    ->where('status','!=','not-cleaned')
                    ->get(); 

            return view('bookings.allocate-rooms',compact('hotelRooms','booking_id','rooms','reservedRooms'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }
   
    public function save(Request $request) {
        try {
            $data = $request->all();
            $booking = Booking::findOrFail($data['bookingId']);
           
            $filterData = [
                'checkin'=>date('Y-m-d',strtotime($booking->checkin)),
                'checkout'=>date('Y-m-d',strtotime($booking->checkout)),
                'total_guest'=>$booking->total_guest,
            ];

            if($request->session()->has('filterData')) {
                $filterData = $request->session()->get('filterData');
            }

            $rooms = $data['rooms'];
            $data['total_guest'] = getTotalGuest($data['rooms']);
            $data['rooms'] = (isset($data['rooms']) && $data['rooms'] != '')?json_encode($data['rooms']):null;
            $data['checkin'] = $filterData['checkin'].config('constant.checkinTime');
            $data['checkout'] = $filterData['checkout'].config('constant.checkoutTime');
            $booking->update($data);     

            DB::table('reserved_rooms')->where('booking_id', $booking->id)->delete();

            foreach($rooms as $key => $value) {
                if (is_array($value)) {
                    $reservedRooms = array('booking_id'=>$booking->id,'room_id'=>$key,'total_room_book'=>count($value));
                    $reserve_rooms = ReservedRooms::create($reservedRooms);
                }
            }
            $request->session()->forget('filterData');
            return redirect()->route('add-guests', $booking->id)->with('message', 'Booking updated successfully');
        } catch(\Illuminate\Database\QueryException $e){
           
        }
    }

    public function saveFrontDeskBooking(Request $request) {
        try {
            $data = $request->all();
            $filterData = $request->session()->get('filterData');
            $validatedData = $request->validate([
                'mobile' => 'required',
            ]);

            /* Create Customer */
            $customer = Customer::where('mobile',$data['mobile'])->first();
            if($customer === null){
                $customerData = array(
                    'name'=>$data['name'],
                    'mobile'=>$data['mobile'],
                    'email'=>($data['email'])?$data['email']:'',
                );
                $customer = Customer::create($customerData);
            }
            
            /*Create Booking*/
            $rooms = $data['rooms'];
            $checkinData = [
                'user_id' => $customer->id,
                'booking_id' => $this->random_strings(6),
                'booking_type' => $data['booking_type'],
                'hotel_id' => $data['hotel_id'],
                'amount' => $data['amount'],
                'total_guest' => getTotalGuest($data['rooms']),
                'rooms' => (isset($data['rooms']) && $data['rooms'] != '')?json_encode($data['rooms']):null,
                'checkin' => $filterData['checkin'].config('constant.checkinTime'),
                'checkout' => $filterData['checkout'].config('constant.checkoutTime'),
                'purpose' => $data['purpose'],
                // 'payment_type' => $data['payment_type'],
                //'order_id' => $data['order_id'],
                //'payment_id' => $data['payment_id'],
                //'payment' => $data['payment'],
                'status' => $data['status'],
            ];  
            $booking = Booking::create($checkinData);
            foreach($rooms as $key => $value) {
                if (is_array($value)) {
                    $reservedRooms = array('booking_id'=>$booking->id,'room_id'=>$key,'total_room_book'=>count($value));
                    $reserve_rooms = ReservedRooms::create($reservedRooms);
                }
            }
            $request->session()->forget('filterData');
            //return redirect()->route('view-booking', $booking->id)->with('message', 'Booking has been created!!');
            return redirect()->route('bookings');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function saveGuests(Request $request) {
        try {
            $data = $request->all();
            foreach ($data['guest'] as $key => $value) {
                
                //echo is_object($value['identity_image']); exit;
                if(isset($value['identity_image']) && is_object($value['identity_image'])){
                    //echo "<pre>";print_r(is_object($value['identity_image'])); exit;
                    $imageFile = strtolower(str_replace(" ","_",$value['name'])).'_identity_'.time().'.'.$value['identity_image']->extension(); 
                    $image = Image::make($value['identity_image']->getRealPath());
                    $image->save('public/identity/' . $imageFile);
                    $data['guest'][$key]['identity_image'] = config('constant.identityMediaPath')."/".$imageFile;
                } 
                
                if(isset($value['profile_image']) && is_object($value['profile_image'])){
                    //echo "hi".$value['profile_image']; exit;
                    $imageFile = strtolower(str_replace(" ","_",$value['name'])).'_identity_'.time().'.'.$value['profile_image']->extension(); 
                    $image = Image::make($value['profile_image']->getRealPath());
                    $image->save('public/identity/' . $imageFile);
                    $data['guest'][$key]['profile_image'] = config('constant.identityMediaPath')."/".$imageFile;
                } 
            }
            $guestMeta = get_booking_meta_row($data['bookingId'],'guest');
            if($guestMeta !== null){
                DB::table('booking_meta')
                ->where('id', $guestMeta->id)
                ->update(['meta_value' => json_encode($data['guest'])]);
            } else {
                DB::table('booking_meta')->insert(
                    ['booking_id' => $data['bookingId'], 'meta_key' => 'guest', 'meta_value' => json_encode($data['guest'])]
                );
            }
            
            return redirect()->route('allocate-rooms', $data['bookingId'])->with('message', 'Booking Created Step 3');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function assignRooms(Request $request) {
        try {
            $data = $request->all();
            
            DB::table('booking_meta')->insert(
                ['booking_id' => $data['bookingId'], 'meta_key' => 'room', 'meta_value' => json_encode($data['hotel_room'])]
            );

            $roomMeta = get_booking_meta_row($data['bookingId'],'room');
            if($roomMeta !== null){
                DB::table('booking_meta')
                ->where('id', $roomMeta->id)
                ->update(['meta_value' => json_encode($data['hotel_room'])]);
            } else {
                DB::table('booking_meta')->insert(
                    ['booking_id' => $data['bookingId'], 'meta_key' => 'room', 'meta_value' => json_encode($data['hotel_room'])]
                );
            }

            return redirect()->back()->with('message', 'Room assigned successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function addDining($booking_id,Request $request){
        try {
            $booking = Booking::find($booking_id); 
            if($booking == null) return redirect()->route('bookings')->with('message', 'No Record found');
            if($booking->status != 'arrvied') return redirect()->route('view-booking',['id'=>$booking_id])->with('message', 'Customer not CHECK IN yet');

            $roomType = array();
            foreach(json_decode($booking->rooms,true) as $key => $value) {
                if ($value) {
                    $roomType[] = $key;
                }
            }
            if(get_booking_meta_row($booking->id,'room') == null) return redirect()->route('view-booking',['id'=>$booking_id])->with('message', 'Room not allocated to customer yet');

            //Existing Order
            $diningMeta = null;
            if(get_booking_meta_row($booking->id,'dining') != null) {
                $diningMeta = json_decode(get_booking_meta_row($booking->id,'dining')->meta_value,true);
            }
            //print_r($diningMeta);

            // Get Rooms
            $roomMeta = json_decode(get_booking_meta_row($booking->id,'room')->meta_value,true);
            $hotelRooms = HotelRoom::where("hotel_id",$booking->hotel_id)
            ->whereIn('id',$roomMeta)->get(); 
            
            return view('bookings.addDining',compact('hotelRooms','booking_id','diningMeta'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function saveDining(Request $request){
        try {
            $data = $request->all();            
            
            $diningMeta = get_booking_meta_row($data['bookingId'],'dining');
            if($diningMeta !== null){
                $existing = json_decode($diningMeta->meta_value,true);
                $arr = array_merge_recursive($existing,$data['item']);
                DB::table('booking_meta')
                ->where('id', $diningMeta->id)
                ->update(['meta_value' => json_encode($arr)]);
            } else {
                DB::table('booking_meta')->insert(
                    ['booking_id' => $data['bookingId'], 'meta_key' => 'dining', 'meta_value' => json_encode($data['item'])]
                );
            }

            return redirect()->back()->with('message', 'Order updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }
    public function delete($id) {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->back()->with('message', 'Booking deleted successfully!');
    }

    public function changeStatus(Request $request,$id) {
        try {
            $status = request()->get('status');
            $booking = Booking::findOrFail($id);
            if ($status == 'cancel' || $status == 'completed') {
                DB::table('reserved_rooms')->where('booking_id', $id)->delete();
            }
            $data = ['status'=>$status];
            if ($status == 'arrvied') {
                if(strtotime($booking->checkout) >= strtotime(date('Y-m-d'))){
                    return response()->json(['status'=>false,'message' => "Arriving can not possible after checkout date"], 200);
                }
            }

            if ($status == 'completed') {
                $diningMeta = get_booking_meta_row($id,'dining');
                $additionalCharge = get_booking_meta_row($id,'additionalCharge');
                $paidAmount = Payment::where('payment', '=', 'success')->where('booking_id', $id)->sum('amount');
                $total = $booking->amount;
                if($diningMeta !== null) {
                    $diningMeta = json_decode($diningMeta->meta_value,true);
                    $total += array_sum($diningMeta['price']);
                }

                if($additionalCharge !== null) {
                    $additionalChargeData = json_decode($additionalCharge->meta_value,true);
                    $total += array_sum($additionalChargeData['price']);
                }

                $leftAmount = $total - $paidAmount;
                if($leftAmount >= 0) {
                    return response()->json(['status'=>false,'message' => "Rs. ".$leftAmount."/- Payment Pending"], 200);
                } else{
                    return response()->json(['status'=>true,'message' => "Booking has successfully checked out"], 200);
                }
            }

            $booking->update($data);
            return response()->json(['status'=>true,'message' => "Booking status has been successfully updated"],200);
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function random_strings($length_of_string)
    {
    
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),
                        0, $length_of_string);
    }

}
