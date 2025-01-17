<?php

namespace App\Models;

use CodeIgniter\Model;


class UsersModel extends Model{
	protected $table = 'users';
	protected $primaryKey = 'user_id';
	protected $allowedFields = ['username', 'email', 'password', 'created_at', 'updated_at'];
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $validationRules = [
		'username' => 'required|min_length[3]|max_length[255]',
		'email' => 'required|valid_email|max_length[255]',
		'password' => 'required|min_length[8]|max_length[255]'
	];


	public function getUsers(){
		return $this->findAll();
	}

	public function createUser($data) {
		return $this->insert($data);
	}

	public function deleteUser($user_id) {
		return $this->delete($user_id);
	}

	public function updateUser($user_id, $data) {
		return $this->update($user_id, $data);
	}

	public function getUserById($user_id) {
		return $this->find($user_id);
	}


}