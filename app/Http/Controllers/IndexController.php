<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\ReservedRooms;
class IndexController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;

    public function __construct()
    {
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

    public function thankYou(Request $request) {
        try {
            $user = Auth::user();
            $booking = $request->session()->get("booking");
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

}

