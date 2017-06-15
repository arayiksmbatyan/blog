<?php 

namespace App\Contracts;

interface CategoryServiceInterface {

    public function allCategory();

    public function addCategory($inputs);

    public function editCategory($id);

    public function updateCategory($inputs, $id);

    public function deleteCategory($id);

    public function getCategoryById($id);

    public function getCategoryByUser($id);
}