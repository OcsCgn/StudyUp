<?php


namespace App\Models;

use CodeIgniter\Model;


class UserSubjectModel extends Model{

	protected $table = 'user_subject';
	protected $primaryKey = 'id';
	protected $allowedFields = ['user_id', 'subject_id', 'created_at', 'updated_at'];
	protected $returnType = 'array';
	protected $useTimestamps = true;

	public function getUserSubjects(){
		return $this->findAll();
	}

	public function getUserSubject($id){
		return $this->find($id);
	}

	public function CreerUserSubject($user_id, $subject_id){
		$data = [
			'user_id' => $user_id,
			'subject_id' => $subject_id,
		];
		$this->save($data);
	}

	public function UpdateUserSubject($id, $data){
		$idexiste = $this->find($id);
		if($idexiste){
			$this->update($id, $data);
		}
	}

	
	public function DeleteUserSubject($id){
		$idexiste = $this->find($id);
		if($idexiste){
			$this->delete($id);
		}
		else{
			return false;	
		}
	}
}


?>