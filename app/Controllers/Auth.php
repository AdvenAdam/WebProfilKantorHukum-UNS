<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
	protected $user;
	function __construct()
	{
		$this->user = new User;
	}
	public function index()
	{
		$data = [
			'title' => 'login page',
			'validation' =>  \Config\Services::validation()
		];
		return view('/auth/login', $data);
	}

	public function login()
	{
		$validation = [
			'login' => [
				'rules' =>  'required',
				'label' => 'Username atau Email',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong"
				]
			],
			'password' => [
				'rules' => 'required|min_length[8]',
				'label' => 'Password',
				'errors' => [
					'required' => '{field} Tidak Boleh Kosong',
					'min_length' => '{field} Harus Berisi 8 Karakter'
				]
			],
		];
		if (!$this->validate($validation)) {
			return redirect()->to('/login')->withInput();
		}
		$login = $this->request->getVar('login');
		$password = $this->request->getVar('password');
		// checking username / email 
		$dataUser = $this->user->where('email=', $login)->orwhere('username=', $login)->first();
		if (!$dataUser) {
			session()->setFlashdata('danger', 'Pastikan Email/Username & Password Anda Benar');
			return redirect()->to('/login');
		} else {
			$pass = $dataUser['password'];
			// mengecek apabila password cocok
			$verify = password_verify($password, $pass);
			if ($verify) {
				// set informasi user yang login 
				$ses_data = [
					'user_id'       => $dataUser['id'],
					'user_name'     => $dataUser['username'],
					'user_image'     => $dataUser['foto'],
					'user_email'    => $dataUser['email'],
					'logged_in'     => TRUE
				];
				session()->set($ses_data);
				session()->setFlashdata('success', 'Selamat Datang, ' . session()->user_name);
				return redirect()->to('/Admin');
			} else {
				session()->setFlashdata('danger', 'Pastikan Email/Username & Password Anda Benar');
				return redirect()->to('/login');
			}
		}
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}
