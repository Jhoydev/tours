<?php

namespace App\Http\Controllers\Attendee\Auth;

use App\Http\Controllers\Controller;
use App\Insignia;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
        session()->forget('base_de_datos');
        session()->forget('key_app');

        if ($request->key_app && $key_app = Insignia::where('key_app',$request->key_app)->first()){
            Config(['database.connections.mysql.database'=> $key_app->database ]);
            session(['base_de_datos' => $key_app->database ]);
            session(['key_app' => $request->key_app ]);
        }
        $this->redirectTo = "portal/$request->key_app/home";
        $this->middleware('guest:attendee')->except('logout');
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('attendee');
    }

    public function showLoginForm($key_app="")
    {
        if  (Auth::guard('web')->check()){
            return back()->with('message_login','Ya estas autenticado en otro tipo de cuenta, por favor cierra esa sesión para poder realizar esta.');
        }
        if($key_app && Insignia::where('key_app',$key_app)->first()){
            return view('attendees.auth.login',compact('key_app'));
        }else{
            return abort('404');
        }
    }

    public function login(Request $request)
    {


        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function username()
    {
        return 'email';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        if (!$key_app = (session()->get('key_app'))){
//            $request->session()->invalidate();
            return abort('404');
        }

//        $request->session()->invalidate();
        return redirect("portal/$key_app/login");
    }

    public function redirectAuthenticated(){
        return view('errors.authenticated');
    }

}
