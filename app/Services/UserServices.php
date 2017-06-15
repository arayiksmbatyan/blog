<?php
	
namespace App\Services;

use App\User;
use App\Contracts\UserServiceInterface;

class UserServices implements UserServiceInterface
{
	public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser($id)
    {
        return $this->user->find($id)->password;
    }

    public function updateUser($id, $inputs)
    {
        return $this->user->where('id', $id)->update($inputs);
    }

    public function getUserEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }
}	
?>