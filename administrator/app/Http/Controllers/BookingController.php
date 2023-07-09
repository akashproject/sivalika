<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ReservedRooms;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

            $bookings = DB::table('bookings');
            
            if(request()->has('cust_id')){
                $bookings->where('user_id', request()->get('cust_id'));
            }

            if(Auth::user()->role == 2){
                $bookings->where('hotel_id', get_user_meta('hotel_id'));
            }
            
            if(request()->has('checkin')){
                $bookings->where('checkin', request()->get('checkin'));
            }

            $bookings = $bookings->get();
            return view('bookings.index',compact('bookings'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
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

    public function AddBookingFromFrontDesk(){
        try {
            $tab = '';
            if(request()->has('tab')){
                $tab = request()->get('tab');
            }
            $hotel = Hotel::where('id',get_user_meta('hotel_id'))->first();
            $rooms = Room::where("hotel_id",$hotel->id)->get();
            return view('bookings.addFromFrontDesk',compact('hotel','rooms','tab'));
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
            echo "<pre>"; print_r($data); exit;
            if($data['tab'] == 'checkin') {
                
            }

            if($data['tab'] == 'guest') {

            }

            if($data['tab'] == 'rooms') {

            }


            return redirect()->back()->with('message', 'Booking updated successfully!');
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
