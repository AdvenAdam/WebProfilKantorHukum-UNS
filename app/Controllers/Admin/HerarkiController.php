<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Peraturan;
use App\Models\Herarki;


class HerarkiController extends BaseController
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
			'title' => 'Manage Herarki',
			'herarki' => $this->herarki->getHerarki(),
			'active' => 'SK',
			'validation' =>  \Config\Services::validation(),
			'submenu' => 'herarki',
		];
		return view('/admin/herarki/index', $data);
	}
	public function save()
	{
		$rule = [
			'herarki' => [
				'rules' => 'required|is_unique[tbl_herarki.herarki]',
				'label' => 'Herarki',
				'errors' => [
					'required' => '{field} Harus Diisi',
					'is_unique' => '{field} Sudah Ada'
				]
			],
			'urutan' => [
				'rules' => 'required|is_unique[tbl_herarki.urutan]',
				'label' => 'Urutan',
				'errors' => [
					'required' => '{field} Harus Diisi',
					'is_unique' => 'No {field} Sudah Ada'
				]
			]
		];
		if (!$this->validate($rule)) {
			session()->setFlashdata('danger', 'Data Gagal Ditambahkan Pastikan Anda Mengisi Data Dengan Benar');
			return redirect()->to('/Admin/Herarki')->withInput();
		}

		$data = [
			'herarki'		=> $this->request->getVar('herarki'),
			'urutan'		=> $this->request->getVar('urutan'),
		];

		$this->herarki->save($data);
		session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
		return redirect()->to('/Admin/Herarki');
	}
	public function update($id)
	{
		$herarki = $this->request->getVar('herarki');
		$urutan = $this->request->getVar('urutan');
		$dataLama = $this->herarki->getHerarki($id);
		if ($herarki != $dataLama['herarki']) {
			$roleHerarki = 'required|is_unique[tbl_herarki.herarki]';
		} else {
			$roleHerarki = 'required';
		}
		if ($urutan != $dataLama['urutan']) {
			$roleUrutan = 'required|is_unique[tbl_herarki.urutan]';
		} else {
			$roleUrutan = 'required';
		}
		$rule = [
			'herarki' => [
				'rules' => $roleHerarki,
				'label' => 'Herarki',
				'errors' => [
					'required' => '{field} Harus Diisi',
					'is_unique' => '{field} Sudah Ada'
				]
			],
			'urutan' => [
				'rules' => $roleUrutan,
				'label' => 'Urutan',
				'errors' => [
					'required' => '{field} Harus Diisi',
					'is_unique' => 'No {field} Sudah Ada'
				]
			]
		];
		if (!$this->validate($rule)) {
			return redirect()->to('/Admin/Herarki')->withInput();
		}
		$data = [
			'id' 			=> $id,
			'herarki'		=> $herarki,
			'urutan'		=> $urutan,
		];

		$this->herarki->save($data);
		session()->setFlashdata('success', 'Data Berhasil Diubah');
		return redirect()->to('/Admin/Herarki');
	}
	public function delete($id)
	{
		$this->herarki->delete($id);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/Herarki');
	}
}
