<?php

namespace App\Http\Middleware;

use Closure, Auth;

class EmailVerify {

   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
   public function handle($request, Closure $next)
   {
       if (Auth::check() && Auth::user()->status == 1) {
           return $next($request);
       }  else {
           return redirect('/register/verify');
       }
       
   }

}