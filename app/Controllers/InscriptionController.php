<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class InscriptionController extends Controller
{
	public function index()
	{
		return view('Utilisateur/InscriptionView');
	}

	public function creer()
	{
		$validation = \Config\Services::validation();

		$validation->setRules([
			'username' =>'required|min_length[5]',
			'nom' => 'required|min_length[3]',
			'prenom' => 'required|min_length[3]',
			'email' => 'required|valid_email|is_unique[client.mail]',
			'password' => 'required|min_length[6]',
			'phone' => 'required|numeric|min_length[10]',
			'dateNaissance' => 'required|valid_date[Y-m-d]',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			session()->setFlashdata('error', 'Une erreur est survenue. Veuillez réessayer.');
			return redirect()->back()->withInput();
		}

		$data = [
			'username' =>$this->request->getPost('username'),
			'nom' => $this->request->getPost('nom'),
			'prenom' => $this->request->getPost('prenom'),
			'email' => $this->request->getPost('email'),
			'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
			'phone' => $this->request->getPost('mobile'),
			'sexe' => $this->request->getPost('sexe'),
			'dateNaissance' => $this->request->getPost('dateNaissance'),
			'token' => bin2hex(random_bytes(16))
		];

		$userModel = new UsersModel();
		if ($userModel->insert($data)) {
			session()->setFlashdata('success', 'Inscription réussie, vous pouvez vous connecter.');
			return redirect()->to('/authentification');
		} else {
			session()->setFlashdata('error', 'Une erreur est survenue. Veuillez réessayer.');
			return redirect()->back()->withInput();
		}
	}
}
