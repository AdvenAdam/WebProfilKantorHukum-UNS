<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Template;

class TemplateController extends BaseController
{
	protected $template;
	function __construct()
	{
		$this->template =  new Template();
	}
	public function index()
	{
		$data = [
			'title' => 'Template Produk Hukum',
			'active' => 'info',
			'submenu' => 'template',
			'template' => $this->template->findAll(),
			'validation' =>  \Config\Services::validation()
		];
		return view('/admin/template/index', $data);
	}

	public function save()
	{
		$judul = $this->request->getVar('judul');
		$file = $this->request->getFile('file');
		if ($file->getError() == 4) {
			$judulFile = 'default.jpg';
		} else {
			$judulFile = $judul . '.' . $file->getClientExtension();
			$file->move('dokumen/template', $judulFile);
		}
		$this->template->save([
			'judul' => $judul,
			'file' => $judulFile
		]);
		session()->setFlashdata('success', 'Data Berhasil DiUbah');
		return redirect()->to('/Admin/Template');
	}

	public function update($id)
	{
		$dataLama = $this->template->find($id);
		$file = $this->request->getFile('file');
		$judul = $this->request->getVar('judul');
		if ($file->getError() == 4) {
			$judulFile = $dataLama['file'];
		} else {
			$judulFile = $judul . '.' . $file->getClientExtension();
			$file->move('dokumen/template', $judulFile);
			unlink('dokumen/template/' . $dataLama['file']);
		}
		$this->template->save([
			'id' => $id,
			'judul' => $judul,
			'file' => $judulFile
		]);
		session()->setFlashdata('success', 'Data Berhasil DiUbah');
		return redirect()->to('/Admin/Dokumen');
	}
	public function delete($id)
	{
		$dataLama = $this->template->find($id);
		$lokasi  = ('dokumen/template' . $dataLama['file']);
		if (file_exists($lokasi)) {
			unlink($lokasi);
		}
		$this->template->delete($id);
		session()->setFlashdata('success', 'Data Berhasil DiUbah');
		return redirect()->to('/Admin/Template');
	}
	public function download($id)
	{
		$data = $this->template->find($id);
		$file = ('dokumen/template/' . $data['file']);
		if (file_exists($file)) {
			return $this->response->download($file, null);
		} else {
			session()->setFlashdata('danger', 'File Tidak Ditemukan');
			return redirect()->to('/Admin/Template');
		}
	}
}
