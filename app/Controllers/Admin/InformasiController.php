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
			'active' => 'informasi',
			'informasi' => $this->informasi->getInfo(),
			'submenu' => '',
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
	function tinymce_upload()
	{
		$config['upload_path'] = './uploadResource/Subimg/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 0;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('file')) {
			$this->output->set_header('HTTP/1.0 500 Server Error');
			exit;
		} else {
			$file = $this->upload->data();
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode(['location' => base_url() . 'uploadResource/Subimg/' . $file['file_name']]))
				->_display();
			exit;
		}
	}
}
