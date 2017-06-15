<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Guard;
use App\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function edit($id)
    {   
        return view('user.account', ['user' => $id]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UserRequest $request, UserServiceInterface $userService)
    {
        $db_old_password = $userService->getUser($id);
        $inp_old_password = $request->get('old-password');

        if (Hash::check($inp_old_password, $db_old_password)) {

            $inputs = [
                'password' => bcrypt($request->get('password'))
            ];

            if($userService->updateUser($id, $inputs)){
                return redirect()->back()->with(['success' => "Password has successfully updated!!!"]);
            }
        }
        return redirect()->back()->with(['error' => "Your old  passwords doesn't fit!!!"]);
    }
}
