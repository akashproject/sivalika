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
           
            $hotel = Hotel::where('id',$data['hotel'])->first();
            $filterData = [
                'checkin'=> $data['t-start'],
                'checkout'=> $data['t-end'],
                'total_guest'=>$data['total_guest'],
            ];
            $request->session()->put('filterData', $filterData);
            return redirect('/hotel/'.$hotel->slug);
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function confirmBooking(Request $request) {
       
        return redirect('/checkout');
    }

    public function checkout(Request $request) {
        try {
            return view('booking.checkout');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

}
