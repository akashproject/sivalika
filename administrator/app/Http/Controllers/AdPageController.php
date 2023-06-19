<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adspage;

class AdPageController extends Controller
{
    public function index()
    {
        try {
            $adPages = Adspage::all();
            
            return view('adPages.index',compact('adPages'));

        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }        
    }

    public function add() {
        try {
            $courseCategories = CourseType::all();
            $centers = Center::all();
            return view('adPages.add',compact('courseCategories','centers'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
    }

    public function show($id)
    {
        try {
            $courseCategories = CourseType::all();
            $centers = Center::all();
            $adPage = Adspage::findorFail($id);
            return view('adPages.show',compact('adPage','courseCategories','centers'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'title' => 'required',
                'slug' => 'required',
            ]);

            if (isset($data['course_type_id']) && $data['course_type_id']!='') {
                $data['course_type_id'] = json_encode($data['course_type_id']);
            }
           
            if($data['adPage_id'] <= 0){
                Adspage::create($data);
            } else {
                $adPage = Adspage::findOrFail($data['adPage_id']);
                $adPage->update($data);
            }
            return redirect()->back()->with('message', 'Ad Page updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }

    public function delete($id) {
        $course = Adspage::findOrFail($id);
        $course->delete();
        return redirect('/administrator/ad-pages');
    }
}
