<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokumenInternal;

class DokumenInternController extends BaseController
{
	protected $dok_internal;
	function __construct()
	{
		$this->dok_internal = new DokumenInternal();
	}
	public function index()
	{
		$data = [
			'title' 		=> 'DokumenInternal',
			'active' 		=> 'internal',
			'submenu'		=> '',
			'validation'	=> \Config\Services::validation(),
			'dok_intern'	=> $this->dok_internal->getDok_internal(),
		];
		return view('admin/dokumen_internal/index', $data);
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
		$jdl = $judul;
		$jdl = preg_replace('/[^A-Za-z0-9\-]/', '', $jdl);
		$filename = $status . '_' . $jdl;
		return $filename;
	}
	public function save()
	{
		$valid = $this->validate($this->rule());
		if (!$valid) {
			return redirect()->to('/Admin/DokumenInternal')->withInput();
		} else {
			$judul = $this->request->getVar('judul');
			$status = $this->request->getVar('status');
			$fileDokumen = $this->request->getFile('file');
			$namaDokumen = $this->setFilename($judul, $status) . '.' . $fileDokumen->getClientExtension();
			$fileDokumen->move('dokumen_internal', $namaDokumen);
			$data = [
				'judul' => $judul,
				'tahun' => $this->request->getVar('tahun'),
				'status' => $status,
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
}
