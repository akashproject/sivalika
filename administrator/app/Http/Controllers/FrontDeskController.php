<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class FrontDeskController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;

    public function index() {
        try {
            $frontdesks = User::where('role',2)->get();
            return view('frontdesks.index',compact('frontdesks'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }        
    }

    public function add() {
        try {
            $hotels = Hotel::all();
            return view('frontdesks.add',compact('hotels'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function show($id) {
        try {
            $frontdesk = User::findorFail($id);
            return view('frontdesks.show',compact('frontdesk'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'name' => 'required',
                'mobile' => 'required',
            ]);

            if($data['user_id'] <= 0){
                $userData = [
                    'username' => strtolower(str_replace(' ', '', $data['name'])),
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'password' => Hash::make($data['password']),
                ];
               $user = User::create($userData);
               if($user){
                    $user_meta = DB::table('user_meta')->insert([
                        'user_id' => $user->id,
                        'meta_key' => 'hotel_id',
                        'meta_value' => $data['hotel_id'],
                    ]);
               }
            } else {
                $institute = User::findOrFail($data['user_id']);
                $institute->update($data);
            }
            return redirect()->back()->with('message', 'Record Updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }

    public function delete($id) {
        $course = Customer::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('message', 'Customer deleted successfully!');
    }
}
