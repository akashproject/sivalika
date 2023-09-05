<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    //
    public function index($booking_id)
    {
        try {
            $payments = Payment::where('booking_id',$booking_id)->get();
            return view('payments.index',compact('payments','booking_id'));

        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }        
    }

    public function add($booking_id) {
        try {
            return view('payments.add',compact('booking_id'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function show($id)
    {
        try {
            $payment = Payment::findorFail($id);
            return view('payments.show',compact('payment'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'amount' => 'required',
                'booking_id' => 'required',
            ]);
           
            if($data['payment_id'] <= 0){
                Payment::create($data);
            } else {
                $institute = Payment::findOrFail($data['payment_id']);
                $institute->update($data);
            }
            return redirect()->back()->with('message', 'Payment updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }
}
