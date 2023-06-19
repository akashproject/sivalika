<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\State;
use App\Models\City;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public $_statusOK = 200;
    public $_statusErr = 500;

    public function index()
    {
        try {
            $hotels = Hotel::all();
            return view('hotels.index',compact('hotels'));

        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }        
    }

    public function add() {
        try {
            $states = State::all();
            return view('hotels.add',compact('states'));
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function show($id)
    {
        try {
            $hotel = Hotel::findorFail($id);
            $states = State::all();
            $cities = City::where('state_id', $hotel->state_id)->orderBy('name', 'asc')->get();
            return view('hotels.show',compact('hotel','states','cities'));
        } catch(\Illuminate\Database\QueryException $e){
        }        
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            $validatedData = $request->validate([
                'title' => 'required',
                'slug' => 'required',
                'description' => 'required',
            ]);

            $data['amenities'] = json_encode($data['amenities']);

           
            if($data['hotel_id'] <= 0){
                Hotel::create($data);
            } else {
                $institute = Hotel::findOrFail($data['hotel_id']);
                $institute->update($data);
            }
            return redirect()->back()->with('message', 'Hotel updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }

    public function delete($id) {
        $course = Hotel::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('message', 'Hotel deleted successfully!');
    }

    public function getCitiesByStateId(Request $request){
        try {
            $data = $request->all();
            $cities = City::where('state_id', $data['state_id'])->orderBy('name', 'asc')->get();
            return response()->json($cities,$this->_statusOK);
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }

    public function gallery($id){
        try {
            $gallery = DB::table('gallery')->where("center_id",$id)->get();
           
            return view('administrator.centers.gallery',compact('gallery','id'));       
        } catch(\Illuminate\Database\QueryException $e){
        }     
    }

    public function saveGallery(Request $request) {
        try {
            $data = $request->all();
            $request->validate([
                'file' => 'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,mp4,m3u8,flv,wmv,avi,mov,3gp',
            ]); 
            // Check is file exist        
            if (!$request->hasFile('file')) {
                return false;
            }

            $today = date("Y-m-d");
            $fileName = $this->rename(str_replace(" ","-",strtolower($request->file->getClientOriginalName())));
            $path = Storage::disk('public')->putFileAs($today,$request->file('file'), $fileName);

            //File successfully upload
            if (!$path) {
                return false;
            }

            $imageType = array("jpeg","png","jpg","webp");
            if(in_array($request->file->extension(), $imageType)){
                $image = Image::make($request->file('file')->getRealPath());
                $dimension = $image->width().'x'.$image->height();
                if($image->width() >= 768){
                    $this->resizeMobile('profile',$fileName,$request);
                }
                $image->resize(120, 120)->save(public_path('upload/'.date("Y-m-d")).'/'."thumb_".$fileName);
            }
            
            $fileArray = array(
                'name' => current(explode('.',$request->file->getClientOriginalName())),
                'type' => $request->file->getMimeType(),
                'filename' => $fileName,
                'alternative' => "",
                'caption' => "",
                'description' => "",
                'extension' => $request->file->extension(),
                'size' => number_format((float)($request->file->getSize()/1024), 2, '.', ''),
                'dimension' => ($dimension)?$dimension:'', 
                'path' => config('constant.relativeMediaPath').'/'.$today,
            );  

            Media::create($fileArray);
            return response()->json($fileArray,$this->_statusOK);
            //return redirect()->back()->with('message', 'Page updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            //var_dump($e->getMessage()); 
        }
    }

    public function resizeMobile($profile,$fileName,$request){
        $config = config('constant.imageSize.'.$profile);
        $image = Image::make($request->file('file')->getRealPath());
        $width = (768 * $image->width()/1920);
        
        $image->resize($width, $width, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('upload/'.date("Y-m-d")).'/'."mobile_".$fileName);
    }

    public function rename($filename){
        if(!Storage::disk('public')->exists(date("Y-m-d").'/'.$filename)){
            return $filename;
        } else {
            if($this->counter > 1){
                $filenameArr = explode("-",$filename);
                $filenameArr['0'] = $this->counter;
                $filename = implode("-",$filenameArr);
            } else {
                $filename = $this->counter.'-'.$filename;
            }
            $this->counter++;
            return $this->rename($filename);
        }
    }

    public function search(Request $request){
        try {
            $data = $request->all();
            $media = Media::where('name', 'like', '%' . $data['keyword'] . '%')
                    ->orWhere('filename', 'like', '%' . $data['keyword'] . '%')
                    ->get();
            $a = '';
            foreach($media as $value){
                $a .= '<a href="javascript:void(0)" class="image-thumbnail">';
                $a .= '<img src="'.getSizedImage('thumb',$value->id).'" alt="'.$value->alternative.'" style="width:100%">';
                $a .= '</a>';
            } 
            return $a;
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
            return response()->json(['error' => $e->errorInfo[2]], 401);
        }
        
    }
}
