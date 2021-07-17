<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Peraturan;
use App\Models\Herarki;


class PeraturanController extends BaseController
{
	protected $peraturan, $herarki;
	function __construct()
	{
		$this->peraturan = new Peraturan();
		$this->herarki = new Herarki();
	}
	public function index()
	{
		$data = [
			'title' => 'Manage Peratuan',
			'peraturan' => $this->peraturan->getPeraturan(),
			'active' => '',
			'submenu' => ''
		];
		return view('/admin/peraturan/index', $data);
	}
	public function create()
	{
		$data = [
			'title' => 'Input Peraturan',
			'herarki' => $this->herarki->getHerarki(),
			'active' => '',
			'submenu' => '',
			'validation' =>  \Config\Services::validation()
		];
		return view('/admin/peraturan/input', $data);
	}
	public function validationRule()
	{
		$data = [
			'herarki' => [
				'rules' => 'required',
				'label' => 'Herarki',
				'errors' => [
					'required' => '{field} Harus Diisi'
				]
			],
			'tahun' => [
				'rules' => 'required',
				'label' => 'Tahun',
				'errors' => [
					'required' => '{field} Harus Diisi'
				]
			],
			'nomor' => [
				'rules' => 'required',
				'label' => 'Nomor',
				'errors' => [
					'required' => '{field} Harus Diisi'
				]
			],
			'detail' => [
				'rules' => 'required',
				'label' => 'Detail',
				'errors' => [
					'required' => '{field} Harus Diisi'
				]
			]
		];
		return $data;
	}
	public function save()
	{

		if (!$this->validate($this->validationRule())) {
			return redirect()->to('/Admin/Peraturan/create')->withInput();
		}
		$data = [
			'id_herarki'	=> $this->request->getVar('herarki'),
			'nomor'			=> $this->request->getVar('nomor'),
			'tahun'			=> $this->request->getVar('tahun'),
			'detail'		=> $this->request->getVar('detail')
		];

		$this->peraturan->save($data);
		session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
		return redirect()->to('/Admin/Peraturan');
	}
	public function edit($id)
	{
		$data = [
			'title' => 'Edit Peraturan',
			'herarki' => $this->herarki->getHerarki(),
			'peraturan' => $this->peraturan->getPeraturan($id),
			'validation' =>  \Config\Services::validation(),
			'active' => '',
			'submenu' => ''
		];

		return view('/admin/peraturan/edit', $data);
	}
	public function update($id)
	{
		if (!$this->validate($this->validationRule())) {
			return redirect()->to('/Admin/Peraturan/edit/' . $id)->withInput();
		}
		$data = [
			'id' 			=> $id,
			'id_herarki'	=> $this->request->getVar('herarki'),
			'nomor'			=> $this->request->getVar('nomor'),
			'tahun'			=> $this->request->getVar('tahun'),
			'detail'		=> $this->request->getVar('detail')
		];

		$this->peraturan->save($data);
		session()->setFlashdata('success', 'Data Berhasil Diubah');
		return redirect()->to('/Admin/Peraturan');
	}
	public function delete($id)
	{
		$this->peraturan->delete($id);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/Peraturan');
	}
}
