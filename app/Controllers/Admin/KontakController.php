<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Kontak;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class KontakController extends BaseController
{
	protected $kontak;
	function __construct()
	{
		$this->kontak = new Kontak();
	}
	public function index()
	{
		$data = [
			'title' => 'Manajemen Masukan',
			'active' => 'info',
			'kontak' => $this->kontak->getKontak(),
			'submenu' => 'masukan',
			'validation' =>  \Config\Services::validation()
		];
		return view('admin/masukan/index', $data);
	}

	public function save()
	{
		$data = [
			'nama' => $this->request->getVar('nama'),
			'email' => $this->request->getVar('email'),
			'phone' => $this->request->getVar('phone'),
			'subject' => $this->request->getVar('subject'),
			'pesan' => $this->request->getVar('pesan'),
		];
		$this->kontak->save($data);
		session()->setFlashdata('success', 'Data Berhasil Terkirim');
		return redirect()->to('/');
	}
	public function delete($id)
	{
		$masukan = $this->kontak->getKontak($id);
		$this->kontak->delete($masukan['id']);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/Masukan');
	}
}
