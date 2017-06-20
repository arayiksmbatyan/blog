<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Post;
use App\Category;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Contracts\CategoryServiceInterface;
use App\Http\Requests;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function add(Request $request, CategoryServiceInterface $categoryService)
    {
        $inputs = $request->all();

        if($categoryService->addCategory($inputs)) {
            return response()->json(['message'=>"Category has successfully created!!!"]);
        }
        return response()->json(['error'=>"Something went wrong!!!"]); 
    }

    public function my(Guard $auth, CategoryServiceInterface $categoryService)
    {
        $categories = $auth->user()->categories;
        return response()->json(['categories'=>$categories]);
    }

    public function all(CategoryServiceInterface $categoryService)
    {
        $categories = $categoryService->allCategory();
        return response()->json(['categories'=>$categories]);
    }

    public function edit($id, CategoryServiceInterface $categoryService)
    {
        $category = $categoryService->editCategory($id);
        return response()->json(['category'=>$category]);
    }

    public function update($id, Request $request, CategoryServiceInterface $categoryService)
    {
        $input = $request->all();
        $categoryService->updateCategory($input, $id);
        return response()->json(['message'=>"Category has successfully updated!!!"]);
    }

    public function delete($id, CategoryServiceInterface $categoryService)
    {
        $categoryService->deleteCategory($id);
        return response()->json(['message'=>"Category has successfully deleted!!!"]);
    }

     public function postsByCategory($id, Post $post, CategoryServiceInterface $categoryService)
    {
        $category = $categoryService->getCategoryById($id);
        $posts = $category->posts;
        return response()->json(['posts'=>$posts, 'category_id' => $id]);            
    }  
}
