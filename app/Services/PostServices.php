<?php
	
namespace App\Services;

use App\Post;
use App\Contracts\PostServiceInterface;

class PostServices implements PostServiceInterface
{
	public function __construct(Post $post)
    {
       $this->post = $post;
    }

     public function allPost() 
    {
    	return $this->post->get();
    }

    public function addPost($inputs)
    {
    	return $this->post->create($inputs);
    }

    public function editPost($id)
    {
    	return $this->post->find($id);
    }

    public function updatePost($inputs, $id)
    {
    	return $this->post->where('id', $id)->update($inputs);
    }

    public function deletePost($id)
    {
    	return $this->post->where('id', $id)->delete();
    }

}	
?>