<?php

namespace App\Http\Controllers;

use App\Post;
use Validator;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\CategoryRequest;
use App\Contracts\PostServiceInterface;
use App\Contracts\CategoryServiceInterface;


class PostController extends Controller
{
     public function __construct(Post $post, Category $category)
    {
        parent::__construct();
       $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostServiceInterface $postService)
    {      
        if ($posts = $postService->allPost()) {
            return view("post.all", ['posts' => $posts]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Guard $auth, CategoryServiceInterface $categoryService)
    {      
        if($categories = $categoryService->getCategoryByUser($auth->id())) {
            return view("post.create", ['categories' => $categories]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Guard $auth, PostServiceInterface $postService)
    {
        $image_name = null;

        if ($request->hasFile('image')) {
            $user_image = $request->file('image');
            $image_name = time().str_random().$user_image->getClientOriginalName();
            $user_image->move(public_path().'/images/', $image_name);
        }

        $inputs = [
            'title' => $request->get('title'),
            'text' => $request->get('text'),
            'image' => $image_name,
            'category_id' => $request->get('category')
        ];

        if ($postService->addPost($inputs)) {
           return redirect()->back()->with(['success' => "Post has successfully created!!!"]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guard $auth, PostServiceInterface $postService)
    {
        if ($posts = $postService->myPost($auth->user())) {
            return view("post.index", ['posts' => $posts]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Guard $auth, CategoryServiceInterface $categoryService, PostServiceInterface $postService)
    {
        if ($post = $postService->editPost($id)) {
            $categories = $categoryService->getCategoryByUser($auth->id());
            return view('post.edit', ['post' => $post, 'categories' => $categories]);   
        } 
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, PostRequest $request, PostServiceInterface $postService)
    {
        $inputs = '';

        if ($request->hasFile('image')) {
            $user_image = $request->file('image');
            $image_name = time().str_random().$user_image->getClientOriginalName();
            $user_image->move(public_path().'/images/', $image_name);

            $inputs = [
                'title' => $request->get('title'),
                'text' => $request->get('text'),
                'image' => $image_name,
                'category_id' => $request->get('category'),
            ];
        } else {
            $inputs = [
                'title' => $request->get('title'),
                'text' => $request->get('text'),
                'category_id' => $request->get('category'),
            ];
        }    

        if ($postService->updatePost($inputs, $id)) {
            return redirect()->back()->with(['success' => "Post has successfully updated!!!"]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PostServiceInterface $postService)
    {
        if ($postService->deletePost($id)) {
            return redirect()->back()->with(['success' => "Post has successfully deleted!!!"]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }
}
