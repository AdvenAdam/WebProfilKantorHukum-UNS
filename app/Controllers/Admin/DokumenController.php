<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Dokumen;
use App\Models\Kategori;
use App\Controllers\Home;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DokumenController extends BaseController
{
	protected $kategori, $dokumen, $home;
	function __construct()
	{
		$this->kategori = new Kategori();
		$this->dokumen = new Dokumen();
	}
	public function index()
	{
		$docs = $this->dokumen->getDokumen();
		$data = [
			'title' => 'Manage Dokumen',
			'kategori' => $this->kategori->getKategoriDokumen(),
			'dokumen' => $this->dokumen->getDokumen(),
			'active' => 'dokumen',
			'submenu' => 'view'
		];

		foreach ($docs as $key => $value) {
			$this->dokumen->save(
				[
					'id' => $value['id'],
					'judul' => strtoupper($value['judul'])
				]
			);
		}
		return view('/admin/dokumen/index', $data);
	}
	public function create()
	{
		$data = [
			'title' => 'Input Dokumen',
			'kategori' => $this->kategori->getKategoriDokumen(),
			'active' => 'dokumen',
			'submenu' => 'input',
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
					'required' => '{field} Harus Diisi',
					'is_unique' => '{field} Sudah Ada'
				]
			],
			'no' => [
				'rules' => 'required',
				'label' => 'No',
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
				'rules' => 'max_size[dokumen,20480]',
				'errors' => [
					'max_size' => 'File yang diupload tidak boleh lebih dari 20MB',
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
		$kategori    = $this->kategori->getKategoriDokumen($id_kategori);
		$namaDokumen = $this->setFilename() . '.' . $fileDokumen->getClientExtension();
		$fileDokumen->move('dokumen/' . $kategori['kategori_dokumen'], $namaDokumen);
		$data = [
			'judul' => $this->request->getVar('judul'),
			'no' => $this->request->getVar('no'),
			'tahun' => $this->request->getVar('tahun'),
			'id_kategori_dokumen' => $id_kategori,
			'status' => null,
			'berlaku' => $this->request->getVar('berlaku'),
			'sampai' => $this->request->getVar('sampai'),
			'dokumen' => $namaDokumen
		];
		$this->dokumen->save($data);
		session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
		return redirect()->to('/Admin/Dokumen');
	}
	public function detail($id)
	{
		$data = [
			'title' => 'Detail Dokumen',
			'dokumen' => $this->dokumen->getDokumen($id),
			'active' => 'dokumen',
			'submenu' => ''
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
			'active' => 'dokumen',
			'submenu' => ''
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
		$kategori    = $this->kategori->getKategoriDokumen($id_kategori);

		// jika tidak ada file diupload dan kategori tidak diubah
		if ($fileDokumen->getError() == 4 && $dataLama['id_kategori_dokumen'] == $id_kategori) {
			$namaDokumen = 'dokumen/' . $kategori['kategori_dokumen'] . '/' . $this->setFilename() . '.' . $extension;
			rename($DokumenLama, $namaDokumen);
			$namaDokumen = $this->setFilename() . '.' . $extension;
			// jika tidak ada file di upload dan kategori Berubah
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
			'no' => $this->request->getVar('no'),
			'tahun' => $this->request->getVar('tahun'),
			'id_kategori_dokumen' => $id_kategori,
			'status' => null,
			'berlaku' => $this->request->getVar('berlaku'),
			'sampai' => $this->request->getVar('sampai'),
			'dokumen' => $namaDokumen
		];
		$this->dokumen->save($data);
		session()->setFlashdata('success', 'Data Berhasil DiUbah');
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
	public function excel()
	{
		$spreadsheet =	new Spreadsheet();
		$kategori = $this->kategori->getKategoriDokumen();
		foreach ($kategori as $key => $value) {
			$spreadsheet->setActiveSheetIndex($key)
				->setCellValue('A1', 'No')
				->setCellValue('B1', 'Nomor Dokumen')
				->setCellValue('C1', 'Tahun')
				->setCellValue('D1', 'Judul')
				->setCellValue('E1', 'Kategori Dokumen')
				->setCellValue('F1', 'Status Berlaku')
				->setCellValue('G1', 'Berlaku Mulai')
				->setCellValue('H1', 'Berlaku Sampai')
				->setCellValue('I1', 'Created At')
				->setCellValue('J1', 'Updated At')
				->setTitle($value['kategori_dokumen']);
			$spreadsheet->createSheet();
		}
		$dok = $this->dokumen->getDokumen();
		$x = 2;
		foreach ($kategori as $key => $value) {
			foreach ($dok as $data) {
				if ($data['status'] == 1) {
					$status_berlaku = "Berlaku";
				} else if ($data['status'] == 2) {
					$status_berlaku = "Tidak Berlaku";
				} else {
					$status_berlaku = "Peraturan Tetap";
				}
				if ($data['id_kategori_dokumen'] === $value['id_kategori_dokumen']) {
					$spreadsheet->setActiveSheetIndex($key)
						->setCellValue('A' . $x, $x - 1)
						->setCellValue('B' . $x, $data['no'])
						->setCellValue('C' . $x, $data['tahun'])
						->setCellValue('D' . $x, strtoupper($data['judul']))
						->setCellValue('E' . $x, $value['kategori_dokumen'])
						->setCellValue('F' . $x, $status_berlaku)
						->setCellValue('G' . $x, $data['berlaku'])
						->setCellValue('H' . $x, $data['sampai'])
						->setCellValue('I' . $x, $data['created_at'])
						->setCellValue('J' . $x, $data['updated_at']);
					$x++;
				} else {
					continue;
				}
			}
			$x = 2;
		}

		$spreadsheet->setActiveSheetIndex(0);
		$writer = new xlsx($spreadsheet);
		$filename = 'data list dokumen kantor hukum tanggal ' . format_indo(date('Y-m-d'));
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
}
