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
			'data' => $this->pengajuan->getData(),
			'perYear' => $this->pengajuan->getYear(),
			'recent' => $this->pengajuan->getData('recent'),
			'title' => 'Pengajuan Nomor',
			'active' => 'nomor',
			'submenu' => 'zz',

		];
		return view('/admin/pengajuan_nomor/index', $data);
	}
	public function nomorChecker($tahun, $no_dokumen)
	{
		$tahuns = $this->pengajuan->findColumn('tahun');
		if ($tahuns == null) {
			$tahuns = [];
		}
		$no_dokumens = $this->pengajuan->findColumn('no_dokumen');
		if (in_array($tahun, $tahuns) && in_array($no_dokumen, $no_dokumens)) {
			return true;
		} else {
			return false;
		}
	}

	public function save()
	{
		$tanggal = $this->request->getVar('tanggal_ditetapkan');
		$data = [
			'no_dokumen' 		=> $this->request->getVar('no_dokumen'),
			'kategori' 			=> $this->request->getVar('kategori'),
			'pengusul' 			=> $this->request->getVar('pengusul'),
			'tanggal_ditetapkan'	=> $tanggal,
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
		$pengusul  =  $this->request->getVar('pengusul');
		$tanggal_ditetapkan  =  $this->request->getVar('tanggal_ditetapkan');

		$data = [
			'id'				=> $id,
			'kategori' 			=> $kategori,
			'no_dokumen' 		=> $no_dokumen,
			'pengusul' 			=> $pengusul,
			'perihal' 			=> $perihal,
			'tahun'				=> date('Y', strtotime($tanggal_ditetapkan)),
			'tanggal_ditetapkan' 	=> $tanggal_ditetapkan,
		];
		$dataLama = $this->pengajuan->getData($id);
		// check data nomor dan tahun lama tidak berubah
		if ($dataLama['no_dokumen'] === $data['no_dokumen'] && $dataLama['tahun'] === $data['tahun']) {
			// pengecekan jika ada perubahan
		} elseif ($this->nomorChecker($data['tahun'], $data['no_dokumen'])) {
			session()->setFlashdata('danger', 'Data Sudah Ada');
			return redirect()->to('/Admin/PengajuanNomor');
		}

		$this->pengajuan->save($data);
		session()->setFlashdata('success', 'Data Berhasil Diubah');
		return redirect()->to('/Admin/PengajuanNomor');
	}

	public function excel($jenis, $tahun)
	{
		if ($jenis != 'SK' && $jenis != 'SE' && $jenis != 'PERATURAN') {
			return redirect()->to('/Admin/PengajuanNomor');
		}
		$year = $this->pengajuan->getYear();
		$data = $this->pengajuan->getData();
		$spreadsheet =	new Spreadsheet();
		$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		// set header & sheet
		foreach ($bulan as $key => $value) {
			$spreadsheet->setActiveSheetIndex($key)
				->setCellValue('A1', 'No')
				->setCellValue('B1', 'Tanggal Ditetapkan')
				->setCellValue('C1', 'Nomor Dokumen')
				->setCellValue('D1', 'Pengusul')
				->setCellValue('E1', 'Tahun')
				->setCellValue('F1', 'Perihal')
				->setCellValue('G1', 'Created At')
				->setCellValue('H1', 'Updated At')
				->setTitle($jenis . '-' . $value);
			$spreadsheet->createSheet();
		}
		// set counter 
		$januari = 2;
		$februari = 2;
		$maret = 2;
		$april = 2;
		$mei = 2;
		$juni = 2;
		$juli = 2;
		$agustus = 2;
		$september = 2;
		$oktober = 2;
		$november = 2;
		$desember = 2;
		// loopinng data
		foreach ($data as $key => $list) {
			if ($list['kategori'] == $jenis && $list['tahun'] == $tahun) {
				$date = strtotime($list['tanggal_ditetapkan']);
				$month =  date("n", $date);
				// counter thing
				switch ($month) {
					case 1:
						$counter = $januari;
						$januari++;
						break;
					case 2:
						$counter = $februari;
						$februari++;
						break;
					case 3:
						$counter = $maret;
						$maret++;
						break;
					case 4:
						$counter = $april;
						$april++;
						break;
					case 5:
						$counter = $mei;
						$mei++;
						break;
					case 6:
						$counter = $juni;
						$juni++;
						break;
					case 7:
						$counter = $juli;
						$juli++;
						break;
					case 8:
						$counter = $agustus;
						$agustus++;
						break;
					case 9:
						$counter = $september;
						$september++;
						break;
					case 10:
						$counter = $oktober;
						$oktober++;
						break;
					case 11:
						$counter = $november;
						$november++;
						break;
					case 12:
						$counter = $desember;
						$desember++;
						break;

					default:
						$counter = $januari;
						break;
				}
				$spreadsheet->setActiveSheetIndex($month - 1)
					->setCellValue('A' . $counter, $counter - 1)
					->setCellValue('B' . $counter, format_indo($list['tanggal_ditetapkan']))
					->setCellValue('C' . $counter, $list['no_dokumen'])
					->setCellValue('D' . $counter, $list['pengusul'])
					->setCellValue('E' . $counter, $list['tahun'])
					->setCellValue('F' . $counter, $list['perihal'])
					->setCellValue('G' . $counter, $list['created_at'])
					->setCellValue('H' . $counter, $list['updated_at']);
				$counter++;
			}
		}
		$spreadsheet->setActiveSheetIndex(0);
		$writer = new xlsx($spreadsheet);
		$filename = 'List Pengajuan Nomor ' . $jenis . ' perTahun ' . $tahun;
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
}
