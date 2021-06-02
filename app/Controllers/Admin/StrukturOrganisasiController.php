<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StrukturOrganisasi;
use App\Models\User;

class StrukturOrganisasiController extends BaseController
{
	protected $struktur, $user;
	function __construct()
	{
		$this->struktur = new StrukturOrganisasi();
		$this->user = new User();
	}
	public function index()
	{
		$data = [
			'title' => 'Struktur Organisasi',
			'active' => 'struktur',
			'submenu' => '',
			'struktur' => $this->struktur->getStruktur(),
			'validation' =>  \Config\Services::validation()
		];
		return view('/admin/strukturOrganisasi/index', $data);
	}
	public function Update($id)
	{
		$dataLama = $this->struktur->getStruktur($id);
		$dataUser = $this->user->getUser(session()->user_id);
		$validation = [
			'password' => [
				'rules' =>  'required',
				'label' => 'Password',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
				]
			],
			'struktur' => [
				'rules' => 'is_image[struktur]|mime_in[struktur,image/jpg,image/jpeg,image/png]|max_size[struktur,2048]',
				'errors' => [
					'is_image' => 'File yang diupload bukan file gambar',
					'max_size' => 'File yang anda pilih terlalu besar(maks(2MB)',
					'is_mime'  => 'File yang diupload bukan file gambar',
				]
			],
		];
		if (!$validation) {
			session()->setFlashdata('danger', 'Data Gagal Diubah');
			return redirect()->to('/Admin/Struktur')->withInput();
		} else {
			$fileStruktur = $this->request->getFile('struktur');
			if ($fileStruktur->getError() == 4) {
				$namaStruktur = $dataLama['struktur_organisasi'];
			} else {
				$namaStruktur = $fileStruktur->getRandomName();
				$fileStruktur->move('image/struktur', $namaStruktur);
				if ($dataLama['struktur_organisasi'] != 'default.jpg') {
					unlink('image/struktur/' . $dataLama['struktur_organisasi']);
				}
			}
			$data = [
				'id'	  			  => $id,
				'struktur_organisasi' => $namaStruktur
			];
			$this->struktur->save($data);
			session()->setFlashdata('success', 'Data Berhasil Diubah');
			return redirect()->to('/Admin/Struktur');
		}
	}
}
