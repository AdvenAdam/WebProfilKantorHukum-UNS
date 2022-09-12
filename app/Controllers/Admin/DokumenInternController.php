<?php

namespace App\Controllers\Admin;



use App\Controllers\BaseController;
use App\Models\DokumenInternal;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class DokumenInternController extends BaseController
{
	protected $dok_internal;
	function __construct()
	{
		$this->dok_internal = new DokumenInternal();
	}
	public function index()
	{
		$this->cekBerlakuDokInt();
		$data = [
			'title' 		=> 'DokumenInternal',
			'active' 		=> 'internal',
			'submenu'		=> '',
			'validation'	=> \Config\Services::validation(),
			'dok_intern'	=> $this->dok_internal->getDok_internal(),
		];
		return view('admin/dokumen_internal/index', $data);
	}
	function document_check()
	{
		$docs = $this->dok_internal;
		$noDok =  $this->request->getVar('no_sk');
		$tahun = $this->request->getVar('tahun');
		if (in_array($noDok, $docs->findColumn('no_sk'))) {
			return false;
		} else {
			return true;
		}
	}
	function rule()
	{
		$rule = [
			'judul' => [
				'rules' => 'required',
				'label' => 'Judul',
				'errors' => [
					'required' => '{field} Harus Diisi'
				]
			],
			'status' => [
				'rules' => 'required',
				'label' => 'Status',
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
			'no_sk' => [
				'rules' => 'required',
				'label' => 'No SK',
				'errors' => [
					'required' => '{field} Harus Diisi'
				]
			],
			'file' => [
				'rules' => 'mime_in[file,application/pdf]|ext_in[file,pdf]',
				'errors' => [
					'mime_in' => 'File yang diupload bukan file PDF',
					'ext_in'  => 'File yang diupload harus berformat PDF',
				]
			],
		];
		return $rule;
	}
	function setFilename($judul, $status)
	{
		if ($status == '1') {
			$status = '[ASLI]';
		} elseif ($status == '0') {
			$status = '[SALINAN]';
		}
		$jdl = str_replace('/', '-', $judul);
		$filename = $status . '_' . $jdl;
		return $filename;
	}
	public function save()
	{
		$valid = $this->validate($this->rule());
		if (!$valid || !$this->document_check()) {
			if (!$this->document_check()) {
				session()->setFlashdata('danger', 'Data Sudah Ada');
			}
			return redirect()->to('/Admin/DokumenInternal')->withInput();
		} else {
			dd('u dumb');
			$judul = strtoupper($this->request->getVar('judul'));
			$status = $this->request->getVar('status');
			$fileDokumen = $this->request->getFile('file');
			$namaDokumen = $this->setFilename($judul, $status) . '.' . $fileDokumen->getClientExtension();
			$fileDokumen->move('dokumen_internal', $namaDokumen);
			$data = [
				'judul' => $judul,
				'tahun' => $this->request->getVar('tahun'),
				'status' => $status,
				'status_berlaku' => null,
				'mulai' => $this->request->getVar('mulai'),
				'sampai' => $this->request->getVar('sampai'),
				'no_sk' => $this->request->getVar('no_sk'),
				'file' => $namaDokumen
			];
			$this->dok_internal->save($data);
			session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
			return redirect()->to('/Admin/DokumenInternal');
		}
	}
	public function delete($id)
	{
		$dokumen = $this->dok_internal->getDok_internal($id);
		$lokasi  = ('dokumen_internal/' . $dokumen['file']);
		if (file_exists($lokasi)) {
			unlink($lokasi);
		}
		$this->dok_internal->delete($dokumen['id']);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/DokumenInternal');
	}
	public function detail($id)
	{
		$data = [
			'title' => 'Detail Dokumen Internal',
			'dokumen' => $this->dok_internal->getDok_internal($id),
			'active' => 'internal',
			'submenu' => ''
		];
		return view('/admin/dokumen_internal/detail', $data);
	}
	public function update($id)
	{
		$valid = $this->validate($this->rule());
		if (!$valid) {
			return redirect()->to('/Admin/DokumenInternal')->withInput();
		} else {
			$data = $this->dok_internal->getDok_internal($id);
			$judul = $this->request->getVar('judul');
			$status = $this->request->getVar('status');
			$dokumenLama = ('dokumen_internal/' . $data['file']);
			$fileDokumen = $this->request->getFile('file');
			if ($fileDokumen->getError() == 4) {
				$namaDokumen = ($this->setFilename($judul, $status) . '.' . 'pdf');
				rename($dokumenLama, 'dokumen_internal/' . $namaDokumen);
			} else {
				$namaDokumen = $this->setFilename($judul, $status) . '.' . $fileDokumen->getClientExtension();
				$fileDokumen->move('dokumen_internal', $namaDokumen);
			}
			$data = [
				'id'	=> $id,
				'judul' => $judul,
				'status' => $status,
				'status_berlaku' => null,
				'mulai' => $this->request->getVar('mulai'),
				'sampai' => $this->request->getVar('sampai'),
				'tahun' => $this->request->getVar('tahun'),
				'no_sk' => $this->request->getVar('no_sk'),
				'file' 	=> $namaDokumen
			];
			$this->dok_internal->save($data);
			session()->setFlashdata('success', 'Data Berhasil Diubah');
			return redirect()->to('/Admin/DokumenInternal');
		}
	}
	public function download($id)
	{
		$data = $this->dok_internal->getDok_internal($id);
		$file = ('dokumen_internal/' . $data['file']);
		if (file_exists($file)) {
			return $this->response->download($file, null);
		} else {
			session()->setFlashdata('danger', 'File Tidak Ditemukan');
			return redirect()->to('/Admin/DokumenInternal');
		}
	}
	public function cekBerlakuDokInt()
	{
		$data = $this->dok_internal->getDok_internal();
		foreach ($data as $value) {
			if (($value['sampai']) != '0000-00-00') {
				if (strtotime($value['sampai']) < strtotime(date('Y-m-d'))) {
					$this->dok_internal->save([
						'id' => $value['id'],
						'status_berlaku' => 2
					]);
				} else if (strtotime($value['sampai']) > strtotime(date('Y-m-d'))) {
					$this->dok_internal->save([
						'id' => $value['id'],
						'status_berlaku' => 1
					]);
				}
			} else {
				$this->dok_internal->save([
					'id' => $value['id'],
					'status_berlaku' => 3
				]);
			}
		}
	}
	public function excel()
	{
		$spreadsheet =	new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Nomor Dokumen')
			->setCellValue('C1', 'Tahun')
			->setCellValue('D1', 'Judul')
			->setCellValue('E1', 'Status Dokumen')
			->setCellValue('F1', 'Status Berlaku')
			->setCellValue('G1', 'Berlaku Mulai')
			->setCellValue('H1', 'Berlaku Sampai')
			->setCellValue('I1', 'Created At')
			->setCellValue('J1', 'Updated At')
			->setTitle('SK');
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(1)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Nomor Dokumen')
			->setCellValue('C1', 'Tahun')
			->setCellValue('D1', 'Judul')
			->setCellValue('E1', 'Status Dokumen')
			->setCellValue('F1', 'Status Berlaku')
			->setCellValue('G1', 'Berlaku Mulai')
			->setCellValue('H1', 'Berlaku Sampai')
			->setCellValue('I1', 'Created At')
			->setCellValue('J1', 'Updated At')
			->setTitle('Peraturan');
		$dok = $this->dok_internal->getDok_internal();
		$x = 2;
		$y = 2;
		foreach ($dok as $val) :
			if ($val['status_berlaku'] == 1) {
				$status_berlaku = "Berlaku";
			} else if ($val['status_berlaku'] == 2) {
				$status_berlaku = "Tidak Berlaku";
			} else {
				$status_berlaku = "Peraturan Tetap";
			}
			if (strlen($val['no_sk']) >= 4) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $x, $x - 1)
					->setCellValue('B' . $x, $val['no_sk'])
					->setCellValue('C' . $x, $val['tahun'])
					->setCellValue('D' . $x, $val['judul'])
					->setCellValue('E' . $x, $val['status'] == '1' ? '[ASLI]' : '[SALINAN]')
					->setCellValue('F' . $x, $status_berlaku)
					->setCellValue('G' . $x, $val['mulai'])
					->setCellValue('H' . $x, $val['sampai'])
					->setCellValue('I' . $x, $val['created_at'])
					->setCellValue('J' . $x, $val['updated_at']);
				$x++;
			} else {
				$spreadsheet->setActiveSheetIndex(1)
					->setCellValue('A' . $y, $y - 1)
					->setCellValue('B' . $y, $val['no_sk'])
					->setCellValue('C' . $y, $val['tahun'])
					->setCellValue('D' . $y, $val['judul'])
					->setCellValue('E' . $y, $val['status'] == '1' ? '[ASLI]' : '[SALINAN]')
					->setCellValue('F' . $y, $status_berlaku)
					->setCellValue('G' . $y, $val['mulai'])
					->setCellValue('H' . $y, $val['sampai'])
					->setCellValue('I' . $y, $val['created_at'])
					->setCellValue('J' . $y, $val['updated_at']);
				$y++;
			}
		endforeach;
		$spreadsheet->setActiveSheetIndex(0);
		$writer = new xlsx($spreadsheet);
		$filename = 'data-internal-tanggal ' . format_indo(date('Y-m-d'));
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
}
