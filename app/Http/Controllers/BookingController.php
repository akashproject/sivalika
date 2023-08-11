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
use Illuminate\Support\Facades\Hash;

use Mail;

class BookingController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function checkAvailability(Request $request) {
        try {
            $data = $request->all();
            $hotel = Hotel::where('id',$data['hotel'])->first();
            $filterData = [
                'checkin'=> $data['t-start'],
                'checkout'=> $data['t-end'],
                'total_guest'=>$data['total_guest'],
            ];
            $request->session()->put('filterData', $filterData);
            setCookie('filterData',json_encode($filterData));

            if (isset($data['submitBy']) && $data['submitBy'] == 'ajax') {
                return response()->json(true, $this->_statusOK);
            } else {
                return redirect('/hotel/'.$hotel->slug);
            }
            
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function proceedToCheckout(Request $request) {
        try {
            $data = $request->all();
            unset($data['_token']);
            $data['amount'] = base64_decode($data['amount']);
            $request->session()->put('checkinRooms', $data);
            return redirect('/checkout');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function checkout(Request $request) {
        try {
            $checkinRooms = $request->session()->get('checkinRooms');
           
            $hotel = Hotel::findOrFail($checkinRooms['hotel_id']);
            return view('booking.checkout',compact('checkinRooms','hotel'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function confirmBooking(Request $request){
        try {
            $data = $request->all();
            $data = array_merge($data,$request->session()->get('checkinRooms'));
            
            $customer = Customer::where('mobile',$data['mobile'])->first();
            if($customer === null){
                $customerData = array(
                    'name'=>$data['firstname'].' '.$data['lastname'],
                    'mobile'=>$data['mobile'],
                    'email'=>$data['email'],
                    'passcode' => Hash::make($data['mobile']),
                );
                $customer = Customer::create($customerData);
            }
            Auth::login($customer);
           

            /*Create Booking*/
            $rooms = $data['rooms'];
            $checkinData = [
                'user_id' => $customer->id,
                'booking_id' => random_strings(6),
                'booking_type' => "Online",
                'hotel_id' => $data['hotel_id'],
                'amount' => $data['amount'],
                'total_guest' => getTotalGuest($data['rooms']),
                'rooms' => (isset($data['rooms']) && $data['rooms'] != '')?json_encode($data['rooms']):null,
                'checkin' => $data['t-start'].config('constant.checkinTime'),
                'checkout' => $data['t-end'].config('constant.checkoutTime'),
                'purpose' => "",
                'payment_type' => "Upi",
                'order_id' => '',
                'payment_id' => '',
                'payment' => "pending",
                'status' => "comfirm",
            ];  
            $booking = Booking::create($checkinData);
            foreach($rooms as $key => $value) {
                if (is_array($value)) {
                    $reservedRooms = array('booking_id'=>$booking->id,'room_id'=>$key,'total_room_book'=>count($value));
                    $reserve_rooms = ReservedRooms::create($reservedRooms);
                }
            }
            $request->session()->forget('filterData');
            
            $request->session()->put("booking",$booking);


            // $user = array(
            //     'name' => "Akash Dutta",
            //     'email' => "akashdutta.scriptcrown@gmail.com",
            // );

            // $orderData = [
            //     'name' => "Akash Dutta",
            //     'email' => "akashdutta.scriptcrown@gmail.com",
            // ];

            // $mail = Mail::send('emails.booking', $orderData, function ($m) use ($user) {
            //     $m->from('sivalika@scriptcrown.com', 'Sivalika Hotel Booking');
            //     $m->to('akashdutta.scriptcrown@gmail.com', "Akash Dutta")->subject('Booking has been completed successfully - ');
            // });
            return redirect('/thank-you');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
        
    }

}
