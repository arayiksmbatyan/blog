<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
// use App\Post;
// use App\User;
// use App\Category;
// use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->middleware('auth.verified');
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function edit($id)
    {   
        return view('myAccount', ['user' => $id]);   
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $db_old_password = $this->user->find($id)->password;
        $inp_old_password = $request->get('old-password');

        if (Hash::check($inp_old_password, $db_old_password)) {

            $inputs = [
                'password' => bcrypt($request->get('password'))
            ];

            if($this->user->where('id', $id)->update($inputs)){
                return redirect()->back()->with(['success' => "Password has successfully updated!!!"]);
            }
        } else {
            return redirect()->back()->with(['error' => "Your old  passwords doesn't fit!!!"]);
        }

    }
}
