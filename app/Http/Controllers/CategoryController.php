<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
        parent::__construct();
       $this->middleware('auth');
       $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->get();
        return view("allCategory", ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("addCategory");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, Guard $auth)
    {
        $inputs = [
            'name' => $request->get('name'),
            'user_id' => $auth->id(),
        ];
        if ($this->category->create($inputs)) {
            $categories = $this->category->get();
            return view("userCategory", ['categories' => $categories]); 
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
    public function show($id)
    {
        $categories = $this->category->get();
        return view("userCategory", ['categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->category->find($id);
        return view("editCategory", ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        if ($this->category->where('id', $id)->update(['name' => $request->get('name')])) {
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
        $this->category->where('id', $id)->delete();
        $categories = $this->category->get();
        return view("allCategory", ['categories' => $categories]);
    }

}
