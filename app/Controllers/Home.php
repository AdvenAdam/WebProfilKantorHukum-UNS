<?php

namespace App\Controllers;

use App\Models\Dokumen;
use App\Models\Slider;
use App\Models\StrukturOrganisasi;
use App\Models\Informasi;
use CodeIgniter\Exceptions\AlertError;


class Home extends BaseController
{
	protected $kategori, $dokumen, $slider, $struktur, $informasi;
	function __construct()
	{
		$this->dokumen = new Dokumen();
		$this->slider = new Slider();
		$this->struktur = new StrukturOrganisasi();
		$this->informasi = new Informasi();
		$this->cekBerlaku();
	}

	public function index()
	{
		$data = [
			'title' 	=> 'Kantor Hukum UNS',
			'dokumen' 	=> $this->dokumen->getDokumen(),
			'slider'	=> $this->slider->getSlider(),
		];

		return view('/user/Home/Home', $data);
	}
	public function detail($id)
	{
		$data = [
			'title'  => 'Detail Dokumen',
			'dokumen' => $this->dokumen->getDokumen($id)
		];
		return view('/user/Dokumen/details', $data);
	}
	public function download($id)
	{
		$data = $this->dokumen->getDokumen($id);
		$file = ('dokumen/' . $data['kategori_dokumen'] . '/' . $data['dokumen']);
		if (file_exists($file)) {
			return $this->response->download($file, null);
		} else {
			session()->setFlashdata('danger', 'File Tidak Ditemukan Harap Melapor Ke Admin');
			return redirect()->to('detailDokumen/' . $data['id']);
		}
	}

	public function profil()
	{
		$data = [
			'title' 	=> 'Profil Kantor Hukum UNS',
			'info'	=> $this->informasi->getInfo(),
		];
		return view('/user/informasi/profil', $data);
	}
	public function tugasPokok()
	{
		$data = [
			'title' 	=> 'Tugas Pokok Kantor Hukum UNS',
			'info'	=> $this->informasi->getInfo(),
		];
		return view('/user/informasi/tugasPokok', $data);
	}
	public function struktur()
	{
		$data = [
			'title' 	=> 'Struktur Organisasi Kantor Hukum UNS',
			'struktur'	=> $this->struktur->getStruktur(),
		];
		return view('/user/informasi/struktur', $data);
	}

	public function cekBerlaku()
	{
		$data = $this->dokumen->getDokumen();
		foreach ($data as $value) {
			if (($value['sampai']) != '0000-00-00') {
				if (strtotime($value['sampai']) < strtotime(date('Y-m-d'))) {
					$this->dokumen->save([
						'id' => $value['id'],
						'status' => 2
					]);
				} else if (strtotime($value['sampai']) > strtotime(date('Y-m-d'))) {
					$this->dokumen->save([
						'id' => $value['id'],
						'status' => 1
					]);
				}
			} else {
				$this->dokumen->save([
					'id' => $value['id'],
					'status' => 3
				]);
			}
		}
	}
}
