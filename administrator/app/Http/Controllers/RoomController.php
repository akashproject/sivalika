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
}
