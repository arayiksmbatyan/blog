<?php
	
namespace App\Services;

use App\Category;
use App\Contracts\CategoryServiceInterface;

class CategoryServices implements CategoryServiceInterface
{
	public function __construct(Category $category)
    {
       $this->category = $category;
    }


	public function allCategory() 
	{
		return $this->category->get();
	}

	public function addCategory($inputs)
	{
		return $this->category->create($inputs);
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

	public function getCategoryByUser($id)
	{
		return $this->category->where('user_id', $id)->get();
	}
}	
?>