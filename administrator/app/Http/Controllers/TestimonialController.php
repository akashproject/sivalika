<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Course;
use App\Models\Recruiter;
class TestimonialController extends Controller
{
    //
    public function index()
    {
        try {
            $testimonials = Testimonial::all();
            return view('testimonials.index',compact('testimonials'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }        
    }

    public function add() {
        try {
            
            $courses = Course::all();
            $recruiters = Recruiter::all();
            return view('testimonials.add',compact('courses','recruiters'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function show($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $courses = Course::all();
            $recruiters = Recruiter::all();
            return view('testimonials.show',compact('testimonial','courses','recruiters'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'name' => 'required',
                'comment' => 'required',
                'course_id' => 'required',
            ]);
            if($data['testimonial_id'] <= 0){
                Testimonial::create($data);
            } else {
                $testimonial = Testimonial::findOrFail($data['testimonial_id']);
                $testimonial->update($data);
            }
            return redirect()->back()->with('message', 'Testimonial updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }
}
