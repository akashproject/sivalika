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

            } else {
                $rooms = Room::where("hotel_id",$hotel->id)->get();
            }

            return view('hotel.view',compact('hotel','rooms','filterData','bookedRoom'));
        } catch(\Illuminate\Database\QueryException $e){
        }
    }
}
