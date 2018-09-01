<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Insignia;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

        if ($request->key_app && $key_app = Insignia::where('key_app',$request->key_app)->first()){
            Config(['database.connections.mysql.database'=> $key_app->database ]);
            session(['base_de_datos' => $key_app->database ]);
        }
        $this->middleware('guest')->except('logout');
    }
}
