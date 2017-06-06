<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['getVerify', 'verify']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_confirm_token' => md5(time().str_random(2)),
        ]);
    }

    protected function getVerify()
    {
        if(Auth::user()->status == 0){
            $token = Auth::user()->email_confirm_token;
            $url = env('APP_URL').'/register/verify/'. $token; 
            $email = Auth::user()->email;
            //dd($url); 
            Mail::send('auth.confirm_email', ['url' => $url], function ($message) use ($email)
            {
                $message->from('arayiksmbatyan@gmail.com', 'Blog');
                $message->to($email);
                $message->subject('Please confirm your email address!!!');
            });
            return view('auth.verify');
        } else{
            return redirect('home');
        }
    }

    protected function verify($token)
    {
        $user = Auth::user();
        if($user && $user->email_confirm_token == $token){
            $user->status = 1;
            $user->save();
            return redirect('home');
        } else{
            return redirect('/login');
        }
    }
}
