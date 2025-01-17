<?php 

use CodeIgniter\Model;


class SubjectModel extends Model{

	protected $table = 'subjects';
	protected $primaryKey = 'id';
	protected $allowedFields = ['name', 'description', 'created_at', 'updated_at'];
	protected $returnType = 'array';
	protected $useTimestamps = true;

	public function getSubjects(){
		return $this->findAll();
	}

	public function getSubject($id){
		return $this->find($id);
	}

	public function CreerSubject($name, $description){
		$data = [
			'name' => $name,
			'description' => $description,
		];
		$this->save($data);
	}	

	public function UpdateSubject($id, $data){
		$idexiste = $this->find($id);
		if($idexiste){
			$this->update($id, $data);
		}
	}

	public function DeleteSubject($id){
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