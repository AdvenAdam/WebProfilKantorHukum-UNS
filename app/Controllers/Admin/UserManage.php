<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;
use Config\Validation;

class UserManage extends BaseController
{
	protected $user;
	function __construct()
	{
		$this->user = new User();
	}
	public function index()
	{
		$data = [
			'active' => 'user',
			'submenu' => '',
			'title'  => 'User Management',
			'user' 	 => $this->user->getUser(),
			'validation' =>  \Config\Services::validation()
		];
		return view('/Admin/UserManage/index', $data);
	}
	public function edit($id)
	{
		$active = $id == session()->user_id ? 'profil' : 'user';
		$data = [
			'active' => $active,
			'submenu' => '',
			'title'  => 'User Edit',
			'list' 	 => $this->user->getUser($id),
			'validation' =>  \Config\Services::validation()
		];
		return view('/Admin/UserManage/edit', $data);
	}

	public function save()
	{
		$validation = [
			'username' => [
				'rules' =>  'required|is_unique[tbl_user.username]',
				'label' => 'Username',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
					'is_unique' => "{field} Sudah Terdaftar"
				]
			],
			'email' => [
				'rules' =>  'required|is_unique[tbl_user.email]',
				'label' => 'Email',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
					'is_unique' => "{field} Sudah Terdaftar"
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
			'repassword' => [
				'rules' => 'required|matches[password]',
				'label' => 'Password',
				'errors' => [
					'required' => '{field} Tidak Boleh Kosong',
					'min_length' => '{field} Tdak Sama'
				]
			],
			'foto' => [
				'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
				'errors' => [
					'is_image' => 'File yang diupload bukan file gambar',
					'max_size' => 'File yang anda pilih terlalu besar',
					'is_mime'  => 'File yang diupload bukan file gambar',
				]
			],
		];
		if (!$this->validate($validation)) {
			session()->setFlashdata('danger', 'Data Gagal Ditambahkan Pastikan Anda Mengisi Data Dengan Benar');
			return redirect()->to('/Admin/User')->withInput();
		}
		$fileFoto = $this->request->getFile('foto');
		if ($fileFoto->getError() == 4) {
			$namaFoto = 'default.jpg';
		} else {
			$namaFoto = $fileFoto->getRandomName();
			$fileFoto->move('image/foto', $namaFoto);
		}
		$data = [
			'username' => $this->request->getVar('username'),
			'email' => $this->request->getVar('email'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'foto' => $namaFoto
		];

		$this->user->save($data);
		session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
		return redirect()->to('/Admin/User');
	}
	public function update($id)
	{
		$dataLama = $this->user->getUser($id);
		if ($dataLama['username'] == $this->request->getVar('username')) {
			$rule_username = 'required';
		} else {
			$rule_username = 'is_unique[tbl_user.username]|required';
		}
		if ($dataLama['email'] == $this->request->getVar('email')) {
			$rule_email = 'required';
		} else {
			$rule_email = 'is_unique[tbl_user.email]|required';
		}
		$validation = [
			'username' => [
				'rules' =>  $rule_username,
				'label' => 'Username',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
					'is_unique' => "{field} Sudah Terdaftar"
				]
			],
			'email' => [
				'rules' =>  $rule_email,
				'label' => 'Email',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
					'is_unique' => "{field} Sudah Terdaftar"
				]
			],
			'password' => [
				'rules' =>  'required',
				'label' => 'Password',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
				]
			],
			'foto' => [
				'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
				'errors' => [
					'is_image' => 'File yang diupload bukan file gambar',
					'max_size' => 'File yang anda pilih terlalu besar(maks(2MB)',
					'is_mime'  => 'File yang diupload bukan file gambar',
				]
			],
		];
		if (!$this->validate($validation)) {
			session()->setFlashdata('danger', 'Data Gagal Diubah Pastikan Anda Mengisi Data Dengan Benar');
			return redirect()->to('/Admin/User/edit/' . $id)->withInput();
		}
		$password = $this->request->getVar('password');
		$pass     = $dataLama['password'];
		$verify = password_verify($password, $pass);
		if ($verify) {
			$fileFoto = $this->request->getFile('foto');
			if ($fileFoto->getError() == 4) {
				$namaFoto = $dataLama['foto'];
			} else {
				$namaFoto = $fileFoto->getRandomName();
				$fileFoto->move('image/foto', $namaFoto);
				if ($dataLama['foto'] != 'default.jpg') {
					unlink('image/foto/' . $dataLama['foto']);
				}
			}
			$data = [
				'id'	   => $id,
				'username' => $this->request->getVar('username'),
				'email'    => $this->request->getVar('email'),
				'foto'     => $namaFoto
			];
			$this->user->save($data);
			session()->setFlashdata('success', 'Data Berhasil Diubah');
			return redirect()->to('/Admin/User');
		} else if (!$verify) {
			session()->setFlashdata('danger', "Password Yang Anda Masukan Salah, Data Tidak Diubah ");
			return redirect()->to('/Admin/User/edit/' . $dataLama['id'])->withInput();
		}
	}
	public function ubahPassword($id)
	{
		$validation = [
			'pass' => [
				'rules' =>  'required',
				'label' => 'Username',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
				]
			],
			'newpass' => [
				'rules' => 'required|min_length[8]',
				'label' => 'Email',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
					'is_unique' => "{field} Sudah Terdaftar"
				]
			],
			'repass' => [
				'rules' => 'required|matches[newpass]',
				'label' => 'Email',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
					'is_unique' => "{field} Sudah Terdaftar"
				]
			],

		];

		if (!$this->validate($validation)) {
			session()->setFlashdata('danger', "Pastikan Anda Data Password Yang Anda Masukan Valid");
			return redirect()->to('/Admin/User/edit/' . $id)->withInput();
		}
		// setelah sukses validasi
		// mendapatkan data password lama
		$dataLama = $this->user->getUser($id);
		$pass = $dataLama['password'];
		// data dari inputan
		$password = $this->request->getVar('pass');
		$newpass = password_hash($this->request->getVar('newpass'), PASSWORD_BCRYPT);
		// jika password cocok
		if (password_verify($password, $pass)) {
			$this->user->save([
				'id' => $id,
				'password' => $newpass
			]);
			session()->setFlashdata('success', "Password Berhasil di Ubah");
			return redirect()->to('/Admin/User/edit/' . $id)->withInput();
		} else {
			session()->setFlashdata('danger', "Password Yang Anda Masukan Salah");
			return redirect()->to('/Admin/User/edit/' . $id)->withInput();
		}
	}
	public function delete($id)
	{
		$user = $this->user->getUser($id);
		$lokasi  = ('image/foto/' . $user['foto']);
		if (file_exists($lokasi)) {
			unlink($lokasi);
		}
		$this->user->delete($user['id']);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/User');
	}
}
