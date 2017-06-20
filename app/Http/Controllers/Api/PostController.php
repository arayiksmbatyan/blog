<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Post;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use App\Contracts\PostServiceInterface;

class PostController extends Controller
{


    public function add(Request $request, PostServiceInterface $postService)
    {
        $image_name = null;

        if ($request->hasFile('image')) {
            $user_image = $request->file('image');
            $image_name = time().str_random().$user_image->getClientOriginalName();
            $user_image->move(public_path().'/images/', $image_name);
        }

        $inputs = $request->only('title', 'text', 'category_id');
        $inputs['image'] = $image_name;

        $postService->addPost($inputs);
        return response()->json(['message'=>"Post has successfully created!!!"]);
    }

    public function my(Guard $auth, PostServiceInterface $postService)
    {
        $posts = $auth->user()->posts;
        return response()->json(['posts' => $posts]);
    }

    public function all(Guard $auth, Post $post)
    {
        $posts = $post->with('category')->get();
        return response()->json(['posts' => $posts]);
    }

    public function edit($id, PostServiceInterface $postService)
    {
        $post = $postService->editPost($id);
        return response()->json(['post'=>$post]);
    }

    public function update($id, Request $request, PostServiceInterface $postService)
    {
        $image_name = null;

        if ($request->hasFile('image')) {
            $user_image = $request->file('image');
            $image_name = time().str_random().$user_image->getClientOriginalName();
            $user_image->move(public_path().'/images/', $image_name);
        }

        $inputs = $request->only('title', 'text', 'category_id');
        $inputs['image'] = $image_name;

        $postService->updatePost($inputs, $id);
        return response()->json(['message'=>"Post has successfully updated!!!"]);
    }

    public function delete($id, PostServiceInterface $postService)
    {
        $postService->deletePost($id);
        return response()->json(['message' => "Post has successfully deleted!!!"]);
    }
    

}
