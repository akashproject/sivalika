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
                            ->select('bookings.id','bookings.booking_id','bookings.user_id','customers.name','customers.mobile','bookings.amount','bookings.payment','bookings.status');
            
            if(request()->has('cust_id')){
                $bookings->where('user_id', request()->get('cust_id'));
            }

            if(Auth::user()->role == 2){
                $bookings->where('hotel_id', get_user_meta('hotel_id'));
            }
            
            if(request()->has('checkin')){
                $bookings->whereDate('checkin', request()->get('checkin'));
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
            return redirect('/add-booking-from-front-desk');
            //$booking = Booking::select('id')->where

        } catch(\Illuminate\Database\QueryException $e){
        }
    }

    public function add() {
        try {
            $hotels = Hotel::all();
            return view('bookings.add',compact('hotels'));
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
            $hotelRooms = array();
            
            $todayBooking = Booking::where('bookings.checkout','>',$checkinTime)->where('bookings.checkin','<',$checkoutTime)->count();
            
            if ($todayBooking > 0) {
                echo DB::table('bookings')
                ->join('reserved_rooms', 'reserved_rooms.booking_id', '=', 'bookings.id')
                ->join('rooms', 'reserved_rooms.room_id', '=', 'rooms.id')
                ->select('rooms.*')
                ->selectRaw('`r`.`room_count` - `rr`.`total_room_book` as `room_count`')
                ->where('bookings.checkout','>',$checkinTime)
                ->where('bookings.checkin','<',$checkoutTime)
                ->toSql();
                exit;
            } else {
                $rooms = Room::where("hotel_id",$hotel->id)->get();
            }
            return view('bookings.addFromFrontDesk',compact('hotel','rooms','hotelRooms','filterData'));
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
            ->select('bookings.*','customers.*','bookings.status as bookingStatus')
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

            $rooms = json_decode(get_booking_meta($booking_id,'room'),true);        
            
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
            return view('bookings.allocate-rooms',compact('hotelRooms','booking_id','rooms'));
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

            DB::table('reserved_rooms')->where('booking_id', $booking)->delete();

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
                'payment_type' => $data['payment_type'],
                'order_id' => $data['order_id'],
                'payment_id' => $data['payment_id'],
                'payment' => $data['payment'],
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
            return redirect()->route('add-guests', $booking->id)->with('message', 'Booking Created Step 2');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function saveGuests(Request $request) {
        try {
            $data = $request->all();
            foreach ($data['guest'] as $key => $value) {
                if(isset($value['identity_image']) && $value['identity_image'] != null){
                    $imageFile = strtolower(str_replace(" ","_",$value['name'])).'_identity_'.time().'.'.$value['identity_image']->extension(); 
                    $image = Image::make($value['identity_image']->getRealPath());
                    $image->save(public_path('identity_image',$imageFile));
                    $data['guest'][$key]['identity_image'] = public_path('identity')."/".$imageFile;
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
                    ['booking_id' => $data['bookingId'], 'meta_key' => 'guest', 'meta_value' => json_encode($data['hotel_room'])]
                );
            }

            return redirect()->back()->with('message', 'Room assigned successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function delete($id) {
        $course = Booking::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('message', 'Booking deleted successfully!');
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
