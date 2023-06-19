<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        try {
            $faqs = Faq::all();
            return view('faq.index',compact('faqs'));

        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function add() {       
        return view('faq.add');
    }

    public function show($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            return view('faq.show',compact('faq'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'question' => 'required',
                'answer' => 'required',
                'status' => 'required',
            ]);
            $data['model'] = json_encode($data['model']);
            if($data['faq_id'] <= 0){
                Faq::create($data);
            } else {
                $faq = Faq::findOrFail($data['faq_id']);
                $faq->update($data);
            }
            return redirect()->back()->with('message', 'FAQ updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }
}
