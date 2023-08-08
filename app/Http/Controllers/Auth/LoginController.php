<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\Customer;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $mobileNumber = $request->input('mobile');
        $otp = $request->input('otp');
    
        $user = Customer::where('mobile', $mobileNumber)->first();

        if (!$user || $otp != "123456") {
            return back()->withErrors(['login_failed' => 'Invalid mobile number or OTP']);
        }
    
        Auth::login($user);
        // $user->otp = null;
        // $user->otp_expiry = null;
        $user->save();
    
        return redirect()->route('thank-you'); // Replace 'dashboard' with your route
    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/administrator');
    }
}
