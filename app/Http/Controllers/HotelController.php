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
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{
    //

    public function view($slug,Request $request)
    {
        try {

            $hotel = Hotel::where('slug',$slug)->first();
            

            $filterData = [
                'checkin'=>date('Y-m-d'),
                'checkout'=>date('Y-m-d', strtotime(' +1 day')),
                'total_guest'=>1,
            ];

            if($request->session()->has('filterData')) {
                $filterData = $request->session()->get('filterData');
            }

            $checkinTime = $filterData['checkin'].config('constant.checkinTime');
            $checkoutTime = $filterData['checkout'].config('constant.checkoutTime');

            $todayBooking = Booking::select('id')->where('bookings.hotel_id',$hotel->id)->where('bookings.checkout','>',$checkinTime)->where('bookings.checkin','<',$checkoutTime)->get();

            $rooms = Room::where("hotel_id",$hotel->id)->get();
            $bookedRoom = array();

            if ($todayBooking->count() > 0) {
                $bookedRoom = DB::table('bookings')
                ->join('reserved_rooms', 'reserved_rooms.booking_id', '=', 'bookings.id')
                ->join('rooms', 'reserved_rooms.room_id', '=', 'rooms.id')
                ->select('reserved_rooms.room_id')
                ->selectRaw('sum(reserved_rooms.total_room_book) as roomstake')              
                ->whereIn('bookings.id',$todayBooking)
                ->where('bookings.hotel_id',$hotel->id)
                ->where('bookings.status','!=','cancel')
                ->groupBy('reserved_rooms.room_id')
                ->get();
            } else {
                $rooms = Room::where("hotel_id",$hotel->id)->get();
            }

            $diff = strtotime($checkoutTime) - strtotime($checkinTime);
            $totalDiff = abs(round($diff / 86400));

            return view('hotel.view',compact('hotel','rooms','filterData','bookedRoom','totalDiff'));
        } catch(\Illuminate\Database\QueryException $e){
        }
    }
}
