<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;

class IndexController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $userData;
    public function __construct()
    {
        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $this->userData = Auth::user();
        if($this->userData->role == 1){
            return view('dashboard');
        }

        $hotel_id = get_user_meta('hotel_id');
        $request->session()->put('hotel_id', $hotel_id);

        $checkinTime = date('Y-m-d').config('constant.checkinTime');
        $checkoutTime = date('Y-m-d', strtotime(' +1 day')).config('constant.checkoutTime');
        
        $booking = Booking::where('hotel_id',$hotel_id)
                ->where('bookings.checkout','>',$checkinTime)
                ->where('bookings.checkin','<',$checkoutTime)->count();

        return view('hotel-dashboard',compact('booking'));
    }

}
