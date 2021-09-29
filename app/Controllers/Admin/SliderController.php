<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Slider;

class SliderController extends BaseController
{
	protected $slider;
	function __construct()
	{
		$this->slider = new slider();
	}
	public function index()
	{
		$data = [
			'title' => 'Manajemen Slider',
			'active' => 'info',
			'slider' => $this->slider->getSlider(),
			'submenu' => 'slider',
			'validation' =>  \Config\Services::validation()
		];
		return view('admin/slider/index', $data);
	}
	public function edit($id)
	{
		$data = [
			'title' => 'Manajemen Slider',
			'active' => 'info',
			'slider' => $this->slider->getSlider($id),
			'submenu' => 'slider',
			'validation' =>  \Config\Services::validation()
		];
		// dd($data);
		return view('admin/slider/edit', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Manajemen Slider',
			'active' => 'info',
			'submenu' => 'slider',
			'validation' =>  \Config\Services::validation()
		];
		return view('admin/slider/input', $data);
	}
	public function validationRule()
	{
		$validation = [
			'judul' => [
				'rules' =>  'required',
				'label' => 'Judul',
				'errors' => [
					'required' => "{field} Tidak Boleh Kosong",
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
		return $validation;
	}
	public function save()
	{
		if (!$this->validate($this->validationRule())) {
			return redirect()->to('/Admin/Slider/create')->withInput();
		}
		$fileFoto = $this->request->getFile('foto');
		if ($fileFoto->getError() == 4) {
			$namaFoto = 'default.jpg';
		} else {
			$namaFoto = $fileFoto->getRandomName();
			$fileFoto->move('image/slider', $namaFoto);
		}
		$data = [
			'judul' => $this->request->getVar('judul'),
			'subjudul' => $this->request->getVar('subjudul'),
			'keterangan' => $this->request->getVar('keterangan'),
			'link' => $this->request->getVar('link'),
			'foto' => $namaFoto,
		];
		$this->slider->save($data);
		session()->setFlashdata('success', 'Berhasil Menambahkan Slider');
		return redirect()->to('/Admin/Slider');
	}

	public function update($id)
	{
		if (!$this->validate($this->validationRule())) {
			return redirect()->to('/Admin/Slider/edit/' . $id)->withInput();
		}
		$dataLama = $this->slider->getSlider($id);
		$fileFoto = $this->request->getFile('foto');
		if ($fileFoto->getError() == 4) {
			$namaFoto = $dataLama['foto'];
		} else {
			$namaFoto = $fileFoto->getRandomName();
			$fileFoto->move('image/slider', $namaFoto);
			if ($dataLama['foto'] != 'default.jpg') {
				unlink('image/slider/' . $dataLama['foto']);
			}
		}
		$data = [
			'id'	   => $id,
			'judul' => $this->request->getVar('judul'),
			'subjudul' => $this->request->getVar('subjudul'),
			'keterangan' => $this->request->getVar('keterangan'),
			'link' => $this->request->getVar('link'),
			'foto' => $namaFoto,
		];
		$this->slider->save($data);
		session()->setFlashdata('success', 'Data Berhasil Diubah');
		return redirect()->to('/Admin/Slider');
	}
	public function delete($id)
	{
		$dataLama = $this->slider->getSlider($id);
		$lokasi  = ('image/slider/' . $dataLama['foto']);
		if (file_exists($lokasi)) {
			unlink($lokasi);
		}
		$this->slider->delete($dataLama['id']);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/Slider');
	}
}
