<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\State;
use App\Models\City;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;

    public function index($hotel_id) {
        try {
            
            $rooms = Room::where("hotel_id",$hotel_id)->get();
            return view('rooms.index',compact('rooms','hotel_id'));

        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }        
    }

    public function getRoomByHotelId(Request $request) {
        try {
            $data = $request->all();
            $rooms = Room::where("hotel_id",$data['hotel_id'])->get();
            return view('rooms.getRoomByHotelId',compact('rooms'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }        
    }

    public function add($hotel_id) {
        try {
            return view('rooms.add',compact('hotel_id'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function show($id) {
        try {
            $room = Room::findorFail($id);
            $room->amenities = json_decode($room->amenities);
            $states = State::all();
            $cities = City::where('state_id', $room->state_id)->orderBy('name', 'asc')->get();
            return view('rooms.show',compact('room','states','cities'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'name' => 'required',
                'status' => 'required',
            ]);

            $data['amenities'] = json_encode($data['amenities']);
            if($data['room_id'] <= 0){
                Room::create($data);
            } else {
                $institute = Room::findOrFail($data['room_id']);
                $institute->update($data);
            }
            return redirect()->back()->with('message', 'Room updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }

    public function delete($id) {
        $course = Room::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('message', 'Room deleted successfully!');
    }

    public function availability() {

        //select `r`.`hotel_id` as `hotel_id`, `r`.`id` as `room_id`, `rr`.`total_room_book`,`r`.`room_count`,`r`.`room_count` - `rr`.`total_room_book` as `room_left`  from `bookings` as `b` inner join `reserved_rooms` as `rr` on `rr`.`booking_id` = `b`.`id` inner join `rooms` as `r` on `rr`.`room_id` = `r`.`id`;
        
        echo DB::table('bookings as b')
                ->join('reserved_rooms as rr', 'rr.booking_id', '=', 'b.id')
                ->join('rooms as r', 'rr.room_id', '=', 'r.id')
                ->select('r.hotel_id as hotel_id','r.id as room_id','rr.total_room_book','r.room_count','b.checkin')
                ->selectRaw('`r`.`room_count` - `rr`.`total_room_book` as `room_left`')
                ->toSql();

    }
}
