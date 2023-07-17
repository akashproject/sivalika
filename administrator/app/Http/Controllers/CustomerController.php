<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;

    public function index() {
        try {
            $customers = DB::table('customers')
                ->join('bookings', 'bookings.user_id', '=', 'customers.id')
                ->select('customers.*');
            if(Auth::user()->role == 2){
                $customers->where('bookings.hotel_id', get_user_meta('hotel_id'));
            }
            $customers->get();
            return view('customers.index',compact('customers'));
        } catch(\Illuminate\Database\QueryException $e){
            throw $e;
        }        
    }

    public function add() {
        try {
            return view('customers.add');
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function show($id) {
        try {
            $customer = Customer::findorFail($id);
            return view('customers.show',compact('customer'));
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

            if($data['customer_id'] <= 0){
                Customer::create($data);
            } else {
                $institute = Customer::findOrFail($data['customer_id']);
                $institute->update($data);
            }
            return redirect()->back()->with('message', 'Customer updated successfully!');
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
