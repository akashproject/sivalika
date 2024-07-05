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
use Razorpay\Api\Api;

use Session;
use Exception;
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

    public function updateBooking(Request $request) {
        try {
            $data = $request->all();
            $totalCost = 0;
            $roomLabel = '';
            foreach ($data['rooms'] as $key => $value) {

                    if(!empty($value)){
                        $room = get_room_by_id($key);
                        $roomLabel .= '<strong> '.count($value).'x '.$room->name.' </strong><br>';
                        $cost = $room->cost;
                        $totalCost += $cost*count($value);
                    }
            }
            $diff = strtotime($data['t-end']) - strtotime($data['t-start']);
            $totalCost = $totalCost*abs(round($diff / 86400));

            

            $response = [
                'cost'=>"₹".$totalCost,
                'encodedCost' => base64_encode($totalCost),
                'roomLabel' => $roomLabel,
            ];
           return response()->json($response, $this->_statusOK);
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function proceedToCheckout(Request $request) {
        try {
            $data = $request->all();
            // echo "<pre>"; print_r($data);
            // exit;
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
            if ($checkinRooms === null) {
                return redirect('/');
            }

            $hotel = Hotel::findOrFail($checkinRooms['hotel_id']);
            if ($hotel === null) {
                return redirect('/');
            }
            return view('booking.checkout',compact('checkinRooms','hotel'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function bookingProcess(Request $request){
        try {
            $data = $request->all();
            $data = array_merge($data,$request->session()->get('checkinRooms'));
            
            if (Auth::check()) {
                $customer = Auth::user();
            } else {
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
            }

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $order = $api->order->create(
                array(
                    'receipt' => 'order_'.random_strings(6),
                    'amount' => $data['amount'] * 100,
                    'currency' => 'INR'
                )
            );
            
            $rooms = $data['rooms'];
            $checkinData = [
                'user_id' => $customer->id,
                'booking_id' => random_strings(6),
                'hotel_id' => $data['hotel_id'],
                'amount' => $data['amount'],
                'total_guest' => getTotalGuest($data['rooms']),
                'rooms' => (isset($data['rooms']) && $data['rooms'] != '')?json_encode($data['rooms']):null,
                'checkin' => $data['t-start'].config('constant.checkinTime'),
                'checkout' => $data['t-end'].config('constant.checkoutTime'),
                'purpose' => "",
                'booking_type' => "Website",
                'payment_type' => "Upi",
                'order_id' => $order['id'],
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

            if($data['payTime'] == 'book_now'){
                return redirect('/payment-process/'.$booking->booking_id);
            }

            if($data['payTime'] == 'pay_later'){
                return redirect('/confirm-booking/'.$booking->booking_id);
            }

        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
        
    }


    public function confirmBooking($booking_id,Request $request){
        try {

            /*get Booking*/
            $booking = Booking::where('booking_id',$booking_id)->first();
            if ($booking === null) {
                return redirect()->back()->with('message', 'Invalid booking!');
            }

            $customer = Auth::user();
            $request->session()->put("booking",$booking);
            $user = array(
                'name' => $customer->name,
                'email' => $customer->email,
                'booking_id' => $booking->booking_id,
                'hotel_id' => $booking->hotel_id,
            );

            $bookingData = [
                'booking_id' => $booking->booking_id,
                'amount' => $booking->amount,
                'hotel_id' => $booking->hotel_id,
                'checkin' => date("d, M",strtotime($booking->checkin)),
                'checkout' => date("d, M",strtotime($booking->checkout)),
                'total_guest' => $booking->total_guest,
                'rooms' => $booking->rooms,
                'customer_name' => $customer->name,
            ];

            if($user['email']){
                $mail = Mail::send('emails.booking', $bookingData, function ($m) use ($user) {
                    $m->from('bookings@sivalikagroup.com', 'Sivalika Group');
                    $m->to($user['email'], $user['name'])->subject('Reservation Confirmed at '.get_hotel_by_id($user['hotel_id'])->name.'. Booking ID: '.$user['booking_id']);
                });
            }

            return redirect('/thank-you');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
        
    }

    public function payment($booking_id,Request $request){
        try {
            
            $user = Auth::user();
            $booking = Booking::where('booking_id',$booking_id)->first();
            if ($booking === null) {
                return redirect()->back()->with('message', 'Invalid booking!');
            }
            $booking->amount = $booking->amount*100;
            return view('customer.payment',compact('booking','user'));
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function paymentSuccess($payment_id,Request $request){
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($payment_id);
           // $payment = $payment->capture(array('amount' => $payment->amount));

            // if($payment['captured']  != "1") {
            //     return view('customer.payment-failed');
            // } 
            $method = $payment['method'];
            $paymentData = [
                'payment_id'=>$payment_id,
                'payment_type'=>$method,
                'payment' => 'success'
            ];
            $booking = Booking::where('order_id', $payment['order_id']);
            $booking->update($paymentData);
            $booking = Booking::where('order_id', $payment['order_id'])->first();
            return redirect('/confirm-booking/'.$booking->booking_id);
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }

    public function paymentFailed(Request $request){
        try {
            return view('customer.payment-failed');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e);
        }
    }
    
}
