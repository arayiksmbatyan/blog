<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\CategoryRequest;
use App\Contracts\CategoryServiceInterface;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
       $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryServiceInterface $categoryService)
    {
        if ($categories = $categoryService->allCategory()) {
            return view("category.index", ['categories' => $categories]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, Guard $auth, CategoryServiceInterface $categoryService)
    {
        $inputs = $request->only('name');
        $inputs['user_id'] = $auth->id();

        if ($categoryService->addCategory($inputs)) {
           return redirect()->back()->with(['success' => "Category has successfully created!!!"]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Guard $auth, CategoryServiceInterface $categoryService)
    {
        $categories = $auth->user()->categories;
        return view("category.user", ['categories' => $categories]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CategoryServiceInterface $categoryService)
    {
         if ($category = $categoryService->editCategory($id)) {
            return view("category.edit", ['category' => $category]);
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
    public function update($id, CategoryRequest $request, CategoryServiceInterface $categoryService)
    {
        $input = ['name' => $request->get('name')];
        if ($categoryService->updateCategory($input, $id)) {
            return redirect()->back()->with(['success' => "Category has successfully updated!!!"]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CategoryServiceInterface $categoryService)
    {
        if ($categoryService->deleteCategory($id)) {
            return redirect()->back()->with(['success' => "Category has successfully deleted!!!"]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);
    }

    public function postsByCategory($id, CategoryServiceInterface $categoryService)
    {
        if ($category = $categoryService->getCategoryById($id)) {
            $posts = $category->posts;
            return view("home.posts", ['posts' => $posts, 'category' => $category->name]);
        }
        return redirect()->back()->with(['error' => "Something went wrong!!!"]);     
    }
}
