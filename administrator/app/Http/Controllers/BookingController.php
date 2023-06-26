<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ReservedRooms;
use App\Models\Hotel;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public $_statusOK = 200;
    public $_statusErr = 500;

    public function index() {
        try {
            $bookings = DB::table('bookings');
            if(request()->has('cust_id')){
                $bookings->where('user_id', request()->get('cust_id'));
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
            if($data['booking_id'] <= 0){
                $booking = Booking::create($data);
                return redirect('/view-booking/'.$booking->id);
            } else {
                $booking = Booking::findOrFail($data['booking_id']);
                $booking->update($data);
            }
            
            foreach($rooms as $key => $value) {
                if (is_array($value)) {
                    $reservedRooms = array('booking_id'=>$booking->id,'room_id'=>$key,'total_room_book'=>count($value));
                    print_r($reservedRooms);
                    $reserve_rooms = ReservedRooms::create($reservedRooms);
                    print_r($reserve_rooms);
                }
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
}
