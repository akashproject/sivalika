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
            $bookings = Booking::where("user_id",$user->id)->get();
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
}
