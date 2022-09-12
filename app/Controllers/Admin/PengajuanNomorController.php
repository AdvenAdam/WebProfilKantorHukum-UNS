<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengajuanNomor;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PengajuanNomorController extends BaseController
{
	protected $pengajuan;
	function __construct()
	{
		$this->pengajuan = new PengajuanNomor();
	}
	public function index()
	{
		$data = [
			'data' => $this->pengajuan->getPengajuan(),
			'title' => 'Pengajuan Nomor',
			'active' => 'zz',
			'submenu' => 'zz',

		];

		return view('/admin/pengajuan_nomor/peraturan/index', $data);
	}
	public function nomorChecker($tahun, $no_dokumen)
	{
		$tahuns = $this->pengajuan->findColumn('tahun');
		$no_dokumens = $this->pengajuan->findColumn('no_dokumen');
		if (in_array($tahun, $tahuns) && in_array($no_dokumen, $no_dokumens)) {
			return true;
		} else {
			return false;
		}
	}

	public function save()
	{
		$tanggal = $this->request->getVar('tanggal_dokumen');
		$data = [
			'no_dokumen' 		=> $this->request->getVar('no_dokumen'),
			'kategori' 			=> $this->request->getVar('kategori'),
			'tanggal_dokumen'	=> $tanggal,
			'tahun'				=> date('Y', strtotime($tanggal)),
			'perihal'			=> $this->request->getVar('perihal')
		];
		// dd($data);
		if ($this->nomorChecker($data['tahun'], $data['no_dokumen'])) {
			session()->setFlashdata('danger', 'Data Sudah Ada');
			return redirect()->to('/Admin/PengajuanNomor');
		}

		$this->pengajuan->save($data);
		session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
		return redirect()->to('/Admin/PengajuanNomor');
	}

	public function delete($id)
	{
		$this->pengajuan->delete($id);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/PengajuanNomor');
	}

	public function update($id)
	{
		$kategori  =  $this->request->getVar('kategori');
		$no_dokumen  =  $this->request->getVar('no_dokumen');
		$perihal  =  $this->request->getVar('perihal');
		$tanggal_dokumen  =  $this->request->getVar('tanggal_dokumen');

		$data = [
			'id'				=> $id,
			'kategori' 			=> $kategori,
			'no_dokumen' 		=> $no_dokumen,
			'perihal' 			=> $perihal,
			'tahun'				=> date('Y', strtotime($tanggal_dokumen)),
			'tanggal_dokumen' 	=> $tanggal_dokumen,
		];
		$dataLama = $this->pengajuan->getPengajuan($id);
		// check data nomor dan tahun lama tidak berubah
		if ($dataLama['no_dokumen'] === $data['no_dokumen'] && $dataLama['tahun'] === $data['tahun']) {
			continue;
			// pengecekan jika ada perubahan
		} elseif ($this->nomorChecker($data['tahun'], $data['no_dokumen'])) {
			session()->setFlashdata('danger', 'Data Sudah Ada');
			return redirect()->to('/Admin/PengajuanNomor');
		}

		$this->pengajuan->save($data);
		session()->setFlashdata('success', 'Data Berhasil Diubah');
		return redirect()->to('/Admin/PengajuanNomor');
	}

	public function excel()
	{
		$spreadsheet =	new Spreadsheet();
		// set header & sheet
		$kategori = ['Surat Keterangan', 'Peraturan', 'Surat Edaran'];
		foreach ($kategori as $key => $value) {
			$spreadsheet->setActiveSheetIndex($key)
				->setCellValue('A1', 'No')
				->setCellValue('B1', 'Nomor Dokumen')
				->setCellValue('C1', 'Tahun')
				->setCellValue('D1', 'Perihal')
				->setCellValue('E1', 'Tanggal Dokumen')
				->setCellValue('F1', 'Created At')
				->setCellValue('G1', 'Updated At')
				->setTitle($value);
			$spreadsheet->createSheet();
		}

		// set counter 
		$SKCounter = 2;
		$PCounter = 2;
		$SECounter = 2;
		// loopinng data
		foreach ($this->pengajuan->getPengajuan() as $key => $list) {
			if ($list['kategori'] === 'SK') {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $SKCounter, $SKCounter - 1)
					->setCellValue('B' . $SKCounter, $list['no_dokumen'])
					->setCellValue('C' . $SKCounter, $list['tahun'])
					->setCellValue('D' . $SKCounter, $list['perihal'])
					->setCellValue('E' . $SKCounter, $list['tanggal_dokumen'])
					->setCellValue('F' . $SKCounter, $list['created_at'])
					->setCellValue('G' . $SKCounter, $list['updated_at']);
				$SKCounter++;
			} elseif ($list['kategori'] === 'PERATURAN') {
				$spreadsheet->setActiveSheetIndex(1)
					->setCellValue('A' . $PCounter, $PCounter - 1)
					->setCellValue('B' . $PCounter, $list['no_dokumen'])
					->setCellValue('C' . $PCounter, $list['tahun'])
					->setCellValue('D' . $PCounter, $list['perihal'])
					->setCellValue('E' . $PCounter, $list['tanggal_dokumen'])
					->setCellValue('F' . $PCounter, $list['created_at'])
					->setCellValue('G' . $PCounter, $list['updated_at']);
				$PCounter++;
			} else {
				$spreadsheet->setActiveSheetIndex(3)
					->setCellValue('A' . $SECounter, $SECounter - 1)
					->setCellValue('B' . $SECounter, $list['no_dokumen'])
					->setCellValue('C' . $SECounter, $list['tahun'])
					->setCellValue('D' . $SECounter, $list['perihal'])
					->setCellValue('E' . $SECounter, $list['tanggal_dokumen'])
					->setCellValue('F' . $SECounter, $list['created_at'])
					->setCellValue('G' . $SECounter, $list['updated_at']);
				$SECounter++;
			}
		}
	}
}
