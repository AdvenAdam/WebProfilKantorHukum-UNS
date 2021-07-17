<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Informasi;

class InformasiController extends BaseController
{
	protected $informasi;
	function __construct()
	{
		$this->informasi = new Informasi();
	}
	public function index()
	{
		$data = [
			'title' => 'Manajemen Informasi',
			'active' => 'info',
			'informasi' => $this->informasi->getInfo(),
			'submenu' => 'informasi',
			'validation' =>  \Config\Services::validation()
		];
		return view('admin/informasi/index', $data);
	}
	public function update($id)
	{
		$dataLama = $this->informasi->getInfo($id);
		$profil = $this->request->getVar('profil');
		$tugas = $this->request->getVar('tugas');
		if ($profil != null) {
			$data = [
				'id' => $id,
				'profil' => $profil,
			];
		}
		if ($tugas != null) {
			$data = [
				'id' => $id,
				'tugas_pokok' => $tugas,
			];
		}
		if ($tugas == null && $profil == null) {
			$data = [
				'id' => $id,
				'profil' => $dataLama['profil'],
				'tugas_pokok' => $dataLama['tugas_pokok'],
			];
		}
		$this->informasi->save($data);
		session()->setFlashdata('success', 'Data Berhasil Diubah');
		return redirect()->to('/Admin/Informasi');
	}
}
