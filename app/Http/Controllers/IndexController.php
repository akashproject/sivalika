<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\ReservedRooms;
use Mail;
class IndexController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;

    public function __construct()
    {
        echo "Website is under Maintaince"; exit;
       // $this->layout = (check_device('mobile'))?"mobile.":'';
    }

    public function index(Request $request) {
        try {
           
            return view('index');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function dashboard()
    {
        // Middleware will check if the user is authenticated
        return view('dashboard');
    }

    public function testMail()
    {
        $user = array(
            'name' => "Akash Dutta",
            'email' => "akashdutta.scriptcrown@gmail.com",
            'booking_id' => "CNMZA7",
            'hotel_id' => 2,
        );

        $bookingData = [
            'booking_id' => "CNMZA7",
            'amount' => "14000",
            'hotel_id' => 2,
            'checkin' => "30 Aug",
            'checkout' => "31 Aug",
            'total_guest' => "7",
            'rooms' => '{"4":{"1":{"adult":"2","child":"0"},"2":{"adult":"2","child":"0"}},"5":{"1":{"adult":"3","child":"0"}}}',
            'customer_name' => "Akash Dutta",
        ];  

        $mail = Mail::send('emails.booking', $bookingData, function ($m) use ($user) {
            $m->from('bookings@sivalikagroup.com', 'Sivalika Group');
            $m->to($user['email'], $user['name'])->subject('Reservation Confirmed at '.get_hotel_by_id($user['hotel_id'])->name.'. Booking ID: '.$user['booking_id']);
        });

        print_r($mail);

    }

    public function thankYou(Request $request) {
        try {
            
            if (!Auth::check()) {
                return redirect('/');
            }

            $user = Auth::user();
            
            $booking = $request->session()->get("booking");
            if (!$booking) {
                return redirect('/');
            }
            $hotel = Hotel::findOrFail($booking->hotel_id);
            $reserve_rooms = ReservedRooms::where("booking_id",$booking->id)->get();
            return view('booking.thank-you',compact('booking','hotel','reserve_rooms'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function submitMobileOtp(Request $request){
        try {
            $data = $request->all();
            $otpvalue = rand(1111,9999);
            $lastdigit = substr($_POST['mobile'], -4);

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://new.icaerp.com/api/data/internalsms?refUser=learnersmallapp&refToken=651145731&Phone='.$data['mobile'].'&textMsg='.$otpvalue.'%20is%20your%20One%20Time%20Password%20(OTP)%20for%20online%20course%20enquiry%20at%20ICA%20Edu%20Skills%20Pvt%20Ltd.%20for%20the%20mobile%20number%20xxxxxx'.$lastdigit.'.%20Thank%20you%20for%20your%20inquiry.%20PLS%20DO%20NOT%20SHARE%20IT%20WITH%20ANYONE%20APART%20FROM%20ICA%20representative.',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $data = array(
                "lastdigit" => $lastdigit,
                "otp_value" => $otpvalue,
            ); 

            if($response){
                $data['status'] = "success";
            } else {
                $data['status'] = "failed";
            }

            return response()->json($data, $this->_statusOK);

        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    function random_strings($length_of_string)
    {
    
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    
        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result), 
                        0, $length_of_string);
    }

    public function privacyPolicy(Request $request) {
        try {
            return view('page.privacy-policy');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }  
    }

    public function termConditions(Request $request) {
        try {
            return view('page.terms-conditions');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }  
    }

    public function contactUs(Request $request) {
        try {
            return view('page.contact-us');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }  
    }

    public function refundCancellation(Request $request) {
        try {
            return view('page.refund-cancellation');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }  
    }

    public function shippingDelivery(Request $request) {
        try {
            return view('page.shipping-delivery');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }  
    }

}

