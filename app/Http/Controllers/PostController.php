<?php

namespace App\Http\Controllers;

use Validator;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\Auth\Guard;


class PostController extends Controller
{
     public function __construct(Post $post, Category $category)
    {
        parent::__construct();
       $this->middleware('auth');
       $this->post = $post;
       $this->category = $category;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->get();
        return view("post.all", ['posts' => $posts]);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Guard $auth)
    {
        $categories = $this->category->where('user_id', $auth->id())->get();
        return view("post.create", ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Guard $auth)
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

        if ($this->post->create($inputs)) {
           return redirect()->back()->with(['success' => "Category has successfully created!!!"]);
        } else {
            return redirect()->back()->with(['error' => "Something went wrong!!!"]);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Guard $auth)
    {
        $user_id = $id;
        $posts = $auth->user()->posts;
        return view("post.index", ['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Guard $auth)
    {
        $categories = $this->category->where('user_id', $auth->id())->get();
        $post = $this->post->find($id);
        return view('post.edit', ['post' => $post, 'categories' => $categories]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $input = '';

        if ($request->hasFile('image')) {

            $user_image = $request->file('image');

            $image_name = time().str_random().$user_image->getClientOriginalName();

            $user_image->move(public_path().'/images/', $image_name);

            $input = [
                'title' => $request->get('title'),
                'text' => $request->get('text'),
                'image' => $image_name,
                'category_id' => $request->get('category'),
            ];
        } else {
            $input = [
                'title' => $request->get('title'),
                'text' => $request->get('text'),
                'category_id' => $request->get('category'),
            ];
        }    

        if ($this->post->where('id', $id)->update($input)) {
            return redirect()->back()->with(['success' => "Category has successfully updated!!!"]);
        } else {
            return redirect()->back()->with(['error' => "Something went wrong!!!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->post->where('id', $id)->delete()) {
            return redirect()->back()->with(['success' => "Category has successfully updated!!!"]);
        } else {
            return redirect()->back()->with(['error' => "Something went wrong!!!"]);
        }

    }
}
