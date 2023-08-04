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
use Mail;

class BookingController extends Controller
{
    //
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
            return redirect('/hotel/'.$hotel->slug);
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function proceedToCheckout(Request $request) {
       
        return redirect('/checkout');
    }

    public function checkout(Request $request) {
        try {
            return view('booking.checkout');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function confirmBooking(Request $request){
        try {
            $data = $request->all();
           // print_r($data);
            //exit;

            $user = array(
                'name' => "Akash Dutta",
                'email' => "akashdutta.scriptcrown@gmail.com",
            );

            $orderData = [
                'name' => "Akash Dutta",
                'email' => "akashdutta.scriptcrown@gmail.com",
            ];

            $mail = Mail::send('emails.booking', $orderData, function ($m) use ($user) {
                $m->from('sivalika@scriptcrown.com', 'Sivalika Hotel Booking');
                $m->to('akashdutta.scriptcrown@gmail.com', "Akash Dutta")->subject('Booking has been completed successfully - ');
            });
            return redirect('/thank-you');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

}
