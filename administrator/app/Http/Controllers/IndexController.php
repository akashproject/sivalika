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

        
        $booking = Booking::where('hotel_id',$hotel_id)
                ->whereDate('checkin', date("Y-m-d"))->count();

        $bookedRoom = DB::table('bookings')
        ->join('reserved_rooms', 'reserved_rooms.booking_id', '=', 'bookings.id')
        ->join('rooms', 'reserved_rooms.room_id', '=', 'rooms.id')
        //->select('reserved_rooms.room_id')
        ->selectRaw('sum(reserved_rooms.total_room_book) as roomstake')              
        //->whereIn('bookings.id',$todayBooking)
        ->where('bookings.hotel_id',get_user_meta('hotel_id'))
        ->whereDate('bookings.checkin',date("Y-m-d"))
        ->where('bookings.status','!=','cancel')
        ->first();
        return view('hotel-dashboard',compact('booking','bookedRoom'));
    }

}
