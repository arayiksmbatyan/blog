<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $inputs = ['email' => $request->input('email'), 'password' => $request->input('password')];

        if(!\Auth::attempt($inputs, $request->has('remember'))){
            return response()->json(['message'=>"Incorect Login or Password"],403);
        }
        $user = $user->where('email', $request->input('email'))->first();
        Auth::login($user);
        return response()->json(['user'=>\Auth::user()],200);
    }

    public function logout()
    {
        \Auth::logout();
        return response()->json(['message'=>"403"], 200);
    }


    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'status' => 1,
            'password' => bcrypt($request->input('password')),
            'email_confirm_token' => md5(time().str_random(2)),
        ]);


        \Auth::login($user);
        return response()->json(['user'=>\Auth::user()],200);
    }

    

}
