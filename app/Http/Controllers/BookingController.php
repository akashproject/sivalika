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

class BookingController extends Controller
{
    //
    public function checkAvailability(Request $request) {
        try {
            $data = $request->all();
            print_r($data); exit;
            
            return view('index');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }
}
