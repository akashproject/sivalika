<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ReservedRooms;
use App\Models\HotelRoom;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    //
    public function booking(Request $request)
    {
        try {
            $user = Auth::user();
            $bookings = Booking::where("user_id",$user->id)->orderby('id','desc')->get();
            return view('customer.booking',compact('bookings'));
        } catch(\Illuminate\Database\QueryException $e){
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = Auth::user();
            return view('customer.profile',compact('user'));
        } catch(\Illuminate\Database\QueryException $e){
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $data = $request->all();
            $user = Auth::user();
            $customerData = [
                'name' => $data['firstname'].' '.$data['lastname'],
                'email' => $data['email'],
                'dob' => $data['dob'],
                'gender' => $data['gender'],
                'marital_status' => $data['marital_status'],
            ];
            $customer = Customer::find($user->id);
            $customer->update($customerData);
            return redirect()->back()->with('message', 'Profile updated successfully!');
           
        } catch(\Illuminate\Database\QueryException $e){
        }
    }

    public function cancelBooking($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $bookingData = [
                'status'=>'cancel'
            ];
            $booking->update($bookingData);
            return redirect()->back()->with('message', $booking->booking_id.' Booking has been cancelled!');
           
        } catch(\Illuminate\Database\QueryException $e){
        }
    }

    
}
