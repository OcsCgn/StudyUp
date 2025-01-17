<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;


class UserController extends BaseController{

	private $model;
	use ResponseTrait;

	function __construct(){
		$this->model = new UsersModel();
	}

	public function index($user_id = null){

		if($user_id){
			$fetchuser = $this->model->getUserById($user_id);
		}else{
			$fetchuser = $this->model->getUsers();
		}
		if(!empty($fetchuser)){
			$result = [
				"status" =>201,
				"data" => $fetchuser,
			];
		}else{
			$result = [
				"status" =>404,
				"data" => "no record found",
			];
		}
		
		return $this->respond($result);
	}

	public function delete($id_user){

		$findUser = $this->model->getUserById($id_user);
		if($findUser){
			$delete = $this->model->deleteUser($id_user);
			if($delete){
				$result = [
					"status" => 404,
					"data" =>"Delete sucessfuly",
				];
			}else{
				$result = [
					"status" => 404,
					"data" =>"Some error fund",
				];
			}
		}else{
			$result = [
					"status" => 404,
					"data" =>"no record fund",
				];
		}
		return $this->respond($result);
	}

	public function create(){

		$data = $this->request->getJSON(true);
			$validation = \Config\Services::validation();
			$validation->setRules([
				'username' => 'required|min_length[3]',
				'email' => 'required|valid_email',
				'nom' => 'required',
				'prenom' => 'required',
				'phone' => 'required|numeric|min_length[10]',
				'dateNaissance' => 'required|valid_date[Y-m-d]',
			]);

		if(!$validation->run($data)){
			return $this->fail($validation->getErrors(), 400);
		}

		$create = $this->model->createUser($data);
		if ($create) {
			$result = [
				"status" => 200,
				"message" => "Utilisateur insérer avec succés",
				"data" => $data
			];
			return $this->respond($result);
		} else {
			return $this->fail("Erreur lors de l'ajout de l'utilisateur", 500);
		}
		
	}

	public function update($user_id){
		// Vérifiez si l'utilisateur existe
		$finduser = $this->model->getUserById($user_id);

		if ($finduser) {
			// Récupérez les données envoyées par le front-end
			$data = $this->request->getJSON(true); // Récupère les données JSON envoyées
			
			// Validez les données (facultatif, mais recommandé)
			$validation = \Config\Services::validation();
			$validation->setRules([
				'username' => 'required|min_length[3]',
				'email' => 'required|valid_email',
				'nom' => 'required',
				'prenom' => 'required',
				'phone' => 'required|numeric|min_length[10]',
				'dateNaissance' => 'required|valid_date[Y-m-d]',
			]);

			if (!$validation->run($data)) {
				return $this->fail($validation->getErrors(), 400);
			}

			// Mise à jour dans la base de données
			$update = $this->model->updateUser($user_id, $data);

			if ($update) {
				$result = [
					"status" => 200,
					"message" => "Utilisateur mis à jour avec succès",
					"data" => $data
				];
				return $this->respond($result);
			} else {
				return $this->fail("Erreur lors de la mise à jour", 500);
			}
		} else {
			return $this->failNotFound("Utilisateur introuvable");
		}
	}
}

?>