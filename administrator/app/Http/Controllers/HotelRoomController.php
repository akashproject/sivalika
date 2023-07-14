<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\HotelRoom;

use Illuminate\Support\Facades\DB;

class HotelRoomController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;

    public function index(Request $request) {
        try {
            $hotel_id = $request->session()->get('hotel_id');
            $rooms = HotelRoom::where("hotel_id",$hotel_id)->get();
            return view('hotel-rooms.index',compact('rooms','hotel_id'));

        } catch(\Illuminate\Database\QueryException $e){
            throw $e;
        }        
    }

    public function add(Request $request) {
        try {
            $hotel_id = $request->session()->get('hotel_id');
            $rooms = Room::where('hotel_id',$hotel_id)->get();
            return view('hotel-rooms.add',compact('rooms'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function show($id,Request $request) {
        try {
            $hotel_id = $request->session()->get('hotel_id');
            $rooms = Room::where('hotel_id',$hotel_id)->get();
            $hotelRoom = HotelRoom::findorFail($id);
            return view('hotel-rooms.show',compact('rooms','hotelRoom'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }


    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'room_id' => 'required',
                'hotel_room_no' => 'required',
            ]);

            if($data['hotelRoom_id'] <= 0){
                $data['hotel_id'] = $request->session()->get('hotel_id');
                HotelRoom::create($data);
            } else {
                $hotelRoom = HotelRoom::findOrFail($data['hotelRoom_id']);
                $hotelRoom->update($data);

                $updatedRoom = HotelRoom::where('room_id',$hotelRoom->room_id)->where('status','active')->orWhere('status','resverd')->count();
                Room::where('id', $hotelRoom->room_id)
                    ->update(['room_count' => $updatedRoom]);
            }
            return redirect()->back()->with('message', 'Room updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }
}
