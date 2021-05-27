<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Dokumen;
use App\Models\Kategori;
use App\Controllers\Home;

class DokumenController extends BaseController
{
	protected $kategori, $dokumen, $home;
	function __construct()
	{
		$this->kategori = new Kategori();
		$this->dokumen = new Dokumen();
		$this->home = new Home();
		$this->home->cekBerlaku();
	}
	public function index()
	{
		$data = [
			'title' => 'Manage Dokumen',
			'kategori' => $this->kategori->getKategoriDokumen(),
			'dokumen' => $this->dokumen->getDokumen(),
			'sidebar' => 'Dokumen'
		];
		return view('/admin/dokumen/index', $data);
	}
	public function create()
	{
		$data = [
			'title' => 'Input Dokumen',
			'kategori' => $this->kategori->getKategoriDokumen(),
			'sidebar' => 'Dokumen',
			'validation' =>  \Config\Services::validation()
		];
		return view('/admin/dokumen/input', $data);
	}

	public function validationRule()
	{
		$data = [
			'judul' => [
				'rules' => 'required',
				'label' => 'Judul',
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
			'kategori_dokumen' => [
				'rules' => 'required',
				'label' => 'Kategori Dokumen',
				'errors' => [
					'required' => '{field} Harus Diisi'
				]
			],
			'dokumen' => [
				'rules' => 'mime_in[dokumen,application/pdf]|ext_in[dokumen,pdf]',
				'errors' => [
					'mime_in' => 'File yang diupload bukan file PDF',
					'ext_in'  => 'File yang diupload harus berformat PDF',
				]
			]

		];
		return $data;
	}

	public function setFilename()
	{
		$judul = $this->request->getVar('judul');
		$judul = preg_replace('/[^A-Za-z0-9\-]/', '', $judul);
		$waktu = date("d-m-Y");
		$filename = $waktu . '_' . $judul;
		return $filename;
	}
	public function save()
	{
		if (!$this->validate($this->validationRule())) {
			return redirect()->to('/Admin/Dokumen/create')->withInput();
		}
		$fileDokumen = $this->request->getFile('dokumen');
		$id_kategori = $this->request->getVar('kategori_dokumen');
		// menentukan nama folder tempat file yg di upload berdasarkan kategori
		$kategori    = $this->kategori->getKategoriById($id_kategori);
		$namaDokumen = $this->setFilename() . '.' . $fileDokumen->getClientExtension();
		$fileDokumen->move('dokumen/' . $kategori['kategori_dokumen'], $namaDokumen);
		$data = [
			'judul' => $this->request->getVar('judul'),
			'tahun' => $this->request->getVar('tahun'),
			'id_kategori_dokumen' => $id_kategori,
			'status' => null,
			'berlaku' => $this->request->getVar('berlaku'),
			'sampai' => $this->request->getVar('sampai'),
			'dokumen' => $namaDokumen
		];
		// dd($data);
		$this->dokumen->save($data);
		return redirect()->to('/Admin/Dokumen');
	}
	public function detail($id)
	{
		$data = [
			'title' => 'Detail Dokumen',
			'dokumen' => $this->dokumen->getDokumen($id),
			'sidebar' => 'Dokumen'
		];
		return view('/admin/dokumen/detail', $data);
	}
	public function edit($id)
	{
		$data = [
			'title' => 'Edit Dokumen',
			'kategori' => $this->kategori->getKategoriDokumen(),
			'dokumen' => $this->dokumen->getDokumen($id),
			'validation' =>  \Config\Services::validation(),
			'sidebar' => 'Dokumen'
		];
		return view('/admin/dokumen/edit', $data);
	}
	public function update($id)
	{
		// melakukan validasi
		if (!$this->validate($this->validationRule())) {
			return redirect()->to('/Admin/Dokumen/edit/' . $id)->withInput();
		}
		// mndapatkan data file lama berdasarkan id
		$dataLama = $this->dokumen->getDokumen($id);
		$namaDokumenLama = $dataLama['dokumen'];
		$DokumenLama = ('dokumen/' . $dataLama['kategori_dokumen'] . '/' . $namaDokumenLama);
		$lokasi = (ROOTPATH . 'dokumen/' . $dataLama['kategori_dokumen'] . '/' . $namaDokumenLama);
		$extension = pathinfo($lokasi, PATHINFO_EXTENSION);
		// mendapatkan file dari input type file 
		$fileDokumen = $this->request->getFile('dokumen');
		// mendapatkan kategori berdasarkan id_kategori yang dinputka di field
		$id_kategori = $this->request->getVar('kategori_dokumen');
		$kategori    = $this->kategori->getKategoriById($id_kategori);

		// jika tidak ada file diupload dan kategori tidak diubah
		if ($fileDokumen->getError() == 4 && $dataLama['id_kategori_dokumen'] == $id_kategori) {
			$namaDokumen = 'dokumen/' . $kategori['kategori_dokumen'] . '/' . $this->setFilename() . '.' . $extension;
			rename($DokumenLama, $namaDokumen);
			$namaDokumen = $this->setFilename() . '.' . $extension;
			// jika tidak ada file di upload dan kategori masih sama
		} else if ($fileDokumen->getError() == 4 && $dataLama['id_kategori_dokumen'] != $id_kategori) {
			$namaDokumen = $this->setFilename() . '.' . $extension;
			rename($DokumenLama, 'dokumen/' . $kategori['kategori_dokumen'] . '/' .  $namaDokumen);
			$namaDokumen = $this->setFilename() . '.' . $extension;
			// jika upload file
		} else if ($fileDokumen->getError() != 4) {
			//membuat nama baru file upload
			$namaDokumen = $this->setFilename() . '.' . $fileDokumen->getClientExtension();
			if (file_exists($DokumenLama)) {
				unlink($DokumenLama);
			}
			$fileDokumen->move('dokumen/' . $kategori['kategori_dokumen'], $namaDokumen);
		}

		$data = [
			'id'	=> $id,
			'judul' => $this->request->getVar('judul'),
			'tahun' => $this->request->getVar('tahun'),
			'id_kategori_dokumen' => $id_kategori,
			'status' => null,
			'berlaku' => $this->request->getVar('berlaku'),
			'sampai' => $this->request->getVar('sampai'),
			'dokumen' => $namaDokumen
		];
		$this->dokumen->save($data);
		return redirect()->to('/Admin/Dokumen');
	}
	public function delete($id)
	{
		$dokumen = $this->dokumen->getDokumen($id);
		$lokasi  = ('dokumen/' . $dokumen['kategori_dokumen'] . '/' . $dokumen['dokumen']);
		if (file_exists($lokasi)) {
			unlink($lokasi);
		}
		$this->dokumen->delete($dokumen['id']);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/Dokumen');
	}
}