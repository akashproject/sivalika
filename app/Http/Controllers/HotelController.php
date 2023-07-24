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

    public function view($slug)
    {
        try {

            $hotel = Hotel::where('slug',$slug)->first();
            $rooms = Room::where('hotel_id',$hotel->id)->where('status',1)->get();

            return view('hotel.view',compact('hotel','rooms'));
        } catch(\Illuminate\Database\QueryException $e){
        }
    }
}
