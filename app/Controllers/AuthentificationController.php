<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class AuthentificationController extends Controller
{
	public function index()
	{
		return view('Utilisateur/AuthentificationView');
	}

	public function connexion()
	{
		$validation = \Config\Services::validation();

		$validation->setRules([
			'email' => 'required|valid_email',
			'motdepasse' => 'required|min_length[6]',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return view('Utilisateur/AuthentificationView', [
				'validation' => $validation,
			]);
		}

		$email = $this->request->getPost('email');
		$motdepasse = $this->request->getPost('motdepasse');

		$userModel = new UsersModel();
		$user = $userModel->where('mail', $email)->first();

		if ($user && password_verify($motdepasse, $user['motdepasse'])) {
			session()->set('user_id', $user['id']);
			return redirect()->to('/');
		} else {
			session()->setFlashdata('error', 'Identifiants incorrects');
			return redirect()->back()->withInput();
		}
	}

	public function deconnexion()
	{
		session()->destroy();
		return redirect()->to('/authentification');
	}
}
