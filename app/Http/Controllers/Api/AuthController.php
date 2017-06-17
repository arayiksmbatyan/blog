<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
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


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $inputs = ['email' => $request->input('email'), 'password' => $request->input('password')];

        if(!\Auth::attempt($inputs, $request->has('remember'))){
            return response()->json(['message'=>"Incorect Login or Password"],403);
        }
        return response()->json(['user'=>\Auth::user()],200);
    }

    public function logout()
    {
        \Auth::logout();
        return response()->json(['message'=>"403"], 200);
    }
}
