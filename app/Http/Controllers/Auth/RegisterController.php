<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Mail;
use Socialite;
use App\SocialProvider;
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
            $url = env('APP_URL', 'http://blog.dev').'/register/verify/'. $token; 
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
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */

    public function handleProviderCallback()
    {
        try 
        {
            $socialUser = Socialite::driver('facebook')->user();

        } 
        catch (Exception $e) 
        {
            return redirect('/');
        }

        if($socialUser->getEmail() != null)
        {
            $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();

            if(!$socialProvider)
            {
                $user = User::firstOrCreate(
                    ['email' => $socialUser->getEmail(),
                    'name' => $socialUser->getName(),
                    'email_confirm_token' => md5(time().str_random(2)),
                    ]
                );
                $user->socialProviders()->create(
                    ['provider_id' => $socialUser->getId(), 'provider' => 'facebook']
                );
            }
            else
                $user = $socialProvider->user;


            auth()->login($user);

            return redirect('/home');
        }
        else
            return redirect('/register')->with('msg', 'Your Facebook account has no email.');

    }
}
