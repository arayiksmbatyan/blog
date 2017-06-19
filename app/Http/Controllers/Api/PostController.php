<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add()
    {
        
    }

    public function my()
    {
        
    }

    public function all()
    {
        
    }

    public function edit()
    {
        
    }

    public function delete()
    {
        
    }
    

}
