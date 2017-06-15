<?php 

namespace App\Contracts;

interface UserServiceInterface {

	public function getUser($id);

	public function updateUser($id, $inputs);

	public function getUserEmail($email);
}
?>