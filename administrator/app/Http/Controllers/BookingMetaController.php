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
use Image;

class BookingMetaController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;
    private $userData;
    public function __construct()
    {
       
    }

    public function addAdditionalCharge($booking_id,Request $request){
        try {
            $booking = Booking::find($booking_id); 
            if($booking == null) return redirect()->route('bookings')->with('message', 'No Record found');
            if($booking->status != 'arrvied') return redirect()->route('view-booking',['id'=>$booking_id])->with('message', 'Customer not CHECK IN yet');

            $roomType = array();
            foreach(json_decode($booking->rooms,true) as $key => $value) {
                if ($value) {
                    $roomType[] = $key;
                }
            }
            if(get_booking_meta_row($booking->id,'room') == null) return redirect()->route('view-booking',['id'=>$booking_id])->with('message', 'Room not allocated to customer yet');

            //Existing Order
            $additionalChargeMeta = null;
            if(get_booking_meta_row($booking->id,'additionalCharge') != null) {
                $additionalChargeMeta = json_decode(get_booking_meta_row($booking->id,'additionalCharge')->meta_value,true);
            }

            // Get Rooms
            $roomMeta = json_decode(get_booking_meta_row($booking->id,'room')->meta_value,true);
            $hotelRooms = HotelRoom::where("hotel_id",$booking->hotel_id)
            ->whereIn('id',$roomMeta)->get(); 
            
            return view('bookingMeta.addadditionalCharge',compact('hotelRooms','booking_id','additionalChargeMeta'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function saveAdditionalCharge(Request $request){
        try {
            $data = $request->all();            
            $additionalChargeMeta = get_booking_meta_row($data['bookingId'],'additionalCharge');
            if($additionalChargeMeta !== null){
                $existing = json_decode($additionalChargeMeta->meta_value,true);
                $arr = array_merge_recursive($existing,$data['item']);
                DB::table('booking_meta')
                ->where('id', $additionalChargeMeta->id)
                ->update(['meta_value' => json_encode($arr)]);
            } else {
                DB::table('booking_meta')->insert(
                    ['booking_id' => $data['bookingId'], 'meta_key' => 'additionalCharge', 'meta_value' => json_encode($data['item'])]
                );
            }

            return redirect()->back()->with('message', 'Order updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function previewBooking($id,Request $request){
        try {
            $booking = Booking::find($id); 
            $hotel = Hotel::find($booking->hotel_id)->name;
            $diningMeta = get_booking_meta_row($id,'dining');
            $additionalCharge = get_booking_meta_row($id,'additionalCharge');
          
            return view('bookingMeta.previewBooking',compact('booking','diningMeta','additionalCharge','hotel'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }
}
