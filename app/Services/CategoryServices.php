<?php
	
namespace App\Services;

use App\Post;
use App\Category;
use App\Contracts\CategoryServiceInterface;

class CategoryServices implements CategoryServiceInterface
{
	public function __construct(Category $category, Post $post)
    {
       $this->category = $category;
       $this->post = $post;
    }


	public function allCategory() 
	{
		return $this->category->get();
	}

	public function addCategory($inputs)
	{
		return $this->category->create($inputs);
	}

	public function myCategory($id)
	{
		return $this->category->get();
	}

	public function editCategory($id)
	{
		return $this->category->find($id);
	}

	public function updateCategory($inputs, $id)
	{
		return $this->category->where('id', $id)->update($inputs);
	}

	public function deleteCategory($id)
	{
		return $this->category->where('id', $id)->delete();
	}

	public function getCategoryById($id)
	{
		return $this->category->find($id);
	}

	public function postsByCategory($id)
	{
        return $this->post->where('category_id', $id)->get();
	}
}	
?>