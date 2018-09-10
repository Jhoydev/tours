<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Insignia;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if  (Auth::guard('customer')->check()){
            return view('errors.authenticated');
        }
        return view('auth.login');
    }
    public function logout(Request $request)
    {
        session()->forget('url.intended');
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(route('login'));
    }
}
