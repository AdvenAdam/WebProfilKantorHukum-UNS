<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Kategori;
use App\Models\Dokumen;
use phpDocumentor\Reflection\Types\This;

class KategoriController extends BaseController
{
	protected $kategori, $dokumen;
	function __construct()
	{
		$this->kategori = new Kategori();
		$this->dokumen = new Dokumen();
	}
	public function index()
	{
		$data = [
			'title' => 'Manajemen Kategori',
			'active' => 'kategori',
			'kategori' => $this->kategori->getKategoriDokumen(),
			'submenu' => '',
			'validation' =>  \Config\Services::validation()
		];
		return view('admin/kategori/index', $data);
	}
	public function save()
	{
		$validation = [
			'kategori' => [
				'rules' => 'required|is_unique[tbl_kategori_dokumen.kategori_dokumen]',
				'label' => 'Kategori',
				'errors' => [
					'required' => '{field} Tidak Boleh Kosong',
					'is_unique' => '{field} Tdak Boleh Sama'
				]
			],

		];
		if (!$this->validate($validation)) {
			session()->setFlashdata('danger', 'Kategori Gagal Ditambahkan');
			return redirect()->to('/Admin/Kategori');
		} else {
			$kategori = $this->request->getVar('kategori');
			$this->kategori->save([
				'kategori_dokumen' => $kategori
			]);
			if (is_dir('dokumen/' . $kategori) == false) {
				mkdir('dokumen/' . $kategori);
			}
			session()->setFlashdata('success', 'Kategori Berhasil Ditambahkan');
			return redirect()->to('/Admin/Kategori');
		}
	}
	public function update($id)
	{
		$dataLama = $this->kategori->getKategoriDokumen($id);
		$kategori = $this->request->getVar('kategori');
		if ($dataLama['kategori_dokumen'] == $kategori) {
			$role_kategori = 'required';
		} else {
			$role_kategori = 'required|is_unique[tbl_kategori_dokumen.kategori_dokumen]';
		}

		$validation = [
			'kategori' => [
				'rules' => $role_kategori,
				'label' => 'Kategori',
				'errors' => [
					'required' => '{field} Tidak Boleh Kosong',
					'is_unique' => '{field} Tdak Boleh Sama'
				]
			]
		];
		if (!$this->validate($validation)) {
			session()->setFlashdata('danger', 'Kategori Gagal Diedit');
			return redirect()->to('/Admin/Kategori')->withInput();
		} else {
			$this->kategori->save([
				'id_kategori_dokumen' => $id,
				'kategori_dokumen' => $kategori,
			]);
			if ($dataLama['kategori_dokumen'] != $kategori) {
				if ($this->dir_is_empty('dokumen/' . $dataLama['kategori_dokumen'])) {
					mkdir('dokumen/' . $kategori);
					rmdir('dokumen/' . $dataLama['kategori_dokumen']);
					//jika folder kategori yang direname tidak kosong 
					//sukses
				} else {
					mkdir('dokumen/' . $kategori);
					$kategoriDirubah = $this->dokumen->getDokumenByKategori($dataLama['id_kategori_dokumen']);
					foreach ($kategoriDirubah as $value) {
						//dokumen dengan kategori yang lama
						$Lama = 'dokumen/' . $dataLama['kategori_dokumen'] . '/' . $value['dokumen'];
						//dokumen dengan kategori yang baru
						$Baru = 'dokumen/' . $kategori . '/' . $value['dokumen'];
						rename($Lama, $Baru);
					}
					rmdir('dokumen/' . $dataLama['kategori_dokumen']);
				}
			}
			session()->setFlashdata('success', 'Kategori Berhasil Diedit');
			return redirect()->to('/Admin/Kategori');
		}
	}
	public function delete($id)
	{
		$kategori = $this->kategori->getKategoriDokumen($id);
		if ($this->dir_is_empty('dokumen/' . $kategori['kategori_dokumen']) == true) {
			rmdir('dokumen/' . $kategori['kategori_dokumen']);
		}
		$this->kategori->delete($kategori['id_kategori_dokumen']);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/Kategori');
	}

	function dir_is_empty($dir)
	{
		$handle = opendir($dir);
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				closedir($handle);
				return FALSE;
			}
		}
		closedir($handle);
		return TRUE;
	}
}
