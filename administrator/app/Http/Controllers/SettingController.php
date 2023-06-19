<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    
    public function show()
    {
        $fieldData = Setting::all();
        $settings = array();
        foreach ($fieldData as $key => $value) {
            $settings[$value->key] = $value->value;
        }
        return view('settings.show',compact('settings'));
    }

    public function save(Request $request)
    {
        //
        try {
            $data = $request->all();
            unset($data['_token']);
            foreach($data as $key => $value){
                $setting = Setting::where('key', $key);    
                if($setting->exists()){
                    $setting->update(array("key"=>$key,"value"=>$value));  
                } else {
                    $setting->create(array("key"=>$key,"value"=>$value)); 
                }

            }
            return redirect()->back()->with('message', 'Page updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }

    }

}
