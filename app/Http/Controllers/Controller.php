<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	$this->users_count = User::all()->count();
    	$this->categories_count = Category::all()->count();
    	$this->posts_count = Post::all()->count();
    	View::share(['posts_count' => $this->posts_count, 'categories_count' => $this->categories_count, 'users_count' => $this->users_count]);
    }
}
