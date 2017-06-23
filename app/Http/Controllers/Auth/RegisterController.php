<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Mail;
use App\User;
use Socialite;
use App\SocialProvider;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Contracts\UserServiceInterface;
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
        if (Auth::user()->status == 0) {
            $token = Auth::user()->email_confirm_token;
            $url = env('APP_URL', 'http://blog.dev').'/register/verify/'. $token; 
            $email = Auth::user()->email;

            Mail::send('auth.confirmEmail', ['url' => $url], function ($message) use ($email)
            {
                $message->from('number.prototype@gmail.com', 'Blog');
                $message->to($email);
                $message->subject('Please confirm your email address!!!');
            });
            return view('auth.verify');
        } else {
            return redirect('home');
        }
    }

    protected function verify($token)
    {
        $user = Auth::user();
        if ($user && $user->email_confirm_token == $token) {
            $user->status = 1;
            $user->save();
            return redirect('home');
        } else {
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

    public function handleProviderCallback(UserServiceInterface $userService)
    {
        try  {
            $social_user = Socialite::driver('facebook')->user();

        } catch (Exception $e) {
            return redirect('/');
        }
        

        if ($social_user->getEmail() != null) {
            $social_provider = SocialProvider::where('provider_id', $social_user->getId())->first();

            $user = '';

            if (!$social_provider && !$userService->getUserEmail($social_user->email)) {
                $user = User::firstOrCreate(
                    ['email' => $social_user->getEmail(),
                    'name' => $social_user->getName(),
                    'email_confirm_token' => md5(time().str_random(2)),
                    ]
                );
                $user->socialProviders()->create(
                    ['provider_id' => $social_user->getId(), 'provider' => 'facebook']
                );
            } elseif (!$social_provider && $userService->getUserEmail($social_user->email)) {

                $user = $userService->getUserEmail($social_user->email);

                $user->socialProviders()->create(
                    ['provider_id' => $social_user->getId(), 'provider' => 'facebook']
                );
            }

            $user = $social_provider->user;
            auth()->login($user);

            return redirect('/home');
        } 
        return redirect('/register')->with('msg', 'Your Facebook account has no email.');

    }
}
