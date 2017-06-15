<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
       return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
       return [
           'old-password' => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
           'password' => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
           'password_confirmation' => 'required'
       ];
   }
   public function messages()
   {
       return [
           'password.min' => 'Your password must be min 6 characters',
           'old-password.min' => 'Your password must be min 6 characters',
           'password.regex' => 'Your password must be  include at least one lowercase letter, one upper case letters, and numbers.',
           'old-password.regex' => 'Your password must be  include at least one lowercase letter, one upper case letters, and numbers.'
       ];
   }
}