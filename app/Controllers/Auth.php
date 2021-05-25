<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'login page'
		];
		return view('/auth/login', $data);
	}

	public function login()
	{
		# code...
	}
}
