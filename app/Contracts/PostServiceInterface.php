<?php 

namespace App\Contracts;

interface PostServiceInterface {

    public function allPost();

    public function addPost($inputs);

    public function editPost($id);

    public function updatePost($inputs, $id);

    public function deletePost($id);

}