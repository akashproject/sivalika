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

            $bookings = $bookings->get();
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
            $data['checkin'] = $data['checkin'].config('constant.checkinTime');
            $data['checkout'] = $data['checkout'].config('constant.checkoutTime');
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
            $tab = '';
            $hotel = Hotel::where('id',get_user_meta('hotel_id'))->first();
            
            $filterData = [
                'checkin'=>date('Y-m-d').config('constant.checkinTime'),
                'checkout'=>date('Y-m-d', strtotime(' +1 day')).config('constant.checkoutTime'),
                'total_guest'=>1,
            ];

            if($request->session()->has('filterData')) {
                $filterData = $request->session()->get('filterData');
            }
            $hotelRooms = array();
            
            $todayBooking = Booking::where('bookings.checkout','>',$filterData['checkin'])->where('bookings.checkin','<',$filterData['checkout'])->count();
            
            if ($todayBooking > 0) {
                echo DB::table('bookings as b')
                ->join('reserved_rooms as rr', 'rr.booking_id', '=', 'b.id')
                ->join('rooms as r', 'rr.room_id', '=', 'r.id')
                ->select('r.hotel_id as hotel_id','r.id as room_id','rr.total_room_book','r.room_count','b.checkin')
                ->selectRaw('`r`.`room_count` - `rr`.`total_room_book` as `room_left`')
                ->where('bookings.checkout','>',$filterData['checkin'])
                ->where('bookings.checkin','<',$filterData['checkout'])
                ->toSql();
                exit;
            } else {
                $rooms = Room::where("hotel_id",$hotel->id)->get();
            }
            return view('bookings.addFromFrontDesk',compact('hotel','rooms','tab','hotelRooms','filterData'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function addGuests($booking_id,Request $request){
        try {
            $booking = Booking::find($booking_id); 
            $guests = json_decode(get_booking_meta($booking_id,'guest'),true);        
            if($guests == null) {
                $guestCount = (isset($booking))?$booking->total_guest:$filterData['total_guest'];   
                $guests = [];
                for ($i=0; $i < $guestCount; $i++) { 
                    $guests[$i] = [
                        'name'=>'','dob'=>'','gender'=>'','address'=>'','city'=>'','state'=>'','pincode'=>'','nationality'=>'','identity_type'=>'','identity'=>'','identity_image'=>'',
                    ];
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
            $roomType = array();
            foreach (json_decode($booking->rooms,true) as $key => $value) {
                if ($value) {
                    $roomType[] = $key;
                }
            }

            $hotelRooms = HotelRoom::where("hotel_id",$booking->hotel_id)
                    ->whereIn('room_id',$roomType)
                    ->where('status','!=','blocked')
                    ->where('status','!=','not-cleaned')
                    ->get(); 
                    
            foreach ($hotelRooms as $key => $value) {
                echo $value->id.' ';
            }

            return view('bookings.allocate-rooms',compact('hotelRooms','booking_id'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    

    public function show($id) {
        try {
            $hotels = Hotel::all();
            $booking = Booking::findorFail($id);
            
            $booking->rooms = (isset($booking->rooms))?json_decode($booking->rooms,true):"";
            
            return view('bookings.show',compact('booking','hotels'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'hotel_id' => 'required',
            ]);
            $customer = Customer::where('mobile',$data['guest_mobile'])->first();
            if($customer === null){
                $customerData = array(
                    'name'=>$data['guest_name'],
                    'mobile'=>$data['guest_mobile'],
                );
                $customer = Customer::create($customerData);
                $data['user_id'] = $customer->id;
            } else {
                $data['user_id'] = $customer->id;
            }
            $rooms = $data['rooms'];
            $data['rooms'] = (isset($rooms) && $rooms != '')?json_encode($rooms):null;
            if($data['bookingId'] <= 0){
                $data['booking_id'] = $this->random_strings(6);
                $booking = Booking::create($data);
            } else {
                $booking = Booking::findOrFail($data['bookingId']);
                $booking->update($data);
            }
            
            foreach($rooms as $key => $value) {
                if (is_array($value)) {
                    $reservedRooms = array('booking_id'=>$booking->id,'room_id'=>$key,'total_room_book'=>count($value));
                    $reserve_rooms = ReservedRooms::create($reservedRooms);
                }
            }
            return redirect()->back()->with('message', 'Booking updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function saveFrontDeskBooking(Request $request) {
        try {
            $data = $request->all();
            $filterData = $request->session()->get('filterData');
            if($data['tab'] == 'checkin') {
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
                    'checkin' => $filterData['checkin'],
                    'checkout' => $filterData['checkout'],
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
                return redirect()->route('add-guests', $booking->id)->with('message', 'Booking Created Step 2');
            }

            if($data['tab'] == 'rooms') {
                $checkinData = $request->session()->get('checkinData');  
                DB::table('booking_meta')->insert(
                    ['booking_id' => $checkinData['booking_id'], 'meta_key' => 'rooms', 'meta_value' => json_encode($data['hotel_room'])]
                );
                return redirect('bookings?checkin='.date('Y-m-d'));
            }


            return redirect()->back()->with('message', 'Booking updated successfully!');
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
