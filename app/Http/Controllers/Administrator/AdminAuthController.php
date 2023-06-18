<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login(){
        return view('administrator.auth.login');
    }
 
    public function verifyLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        if(auth()->guard('auth')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $user = auth()->guard('auth')->user();
            if($user->is_admin == '1'){
                return redirect()->route('dashboard');
            }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }
 
    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
    }
}
