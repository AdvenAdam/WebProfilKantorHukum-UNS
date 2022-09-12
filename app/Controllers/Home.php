<?php

namespace App\Controllers;

use App\Models\Dokumen;
use App\Models\Slider;
use App\Models\Kategori;
use App\Models\StrukturOrganisasi;
use App\Models\Informasi;
use App\Models\Pengumuman;
use App\Models\Template;
use CodeIgniter\Exceptions\AlertError;


class Home extends BaseController
{
	protected $kategori, $dokumen, $slider, $struktur, $informasi, $template, $pengumuman;
	function __construct()
	{
		$this->dokumen = new Dokumen();
		$this->slider = new Slider();
		$this->struktur = new StrukturOrganisasi();
		$this->informasi = new Informasi();
		$this->kategori = new Kategori();
		$this->template = new Template();
		$this->pengumuman = new Pengumuman();
	}

	public function index()
	{
		if (session()->logged_in ==  true) {
			return redirect()->to('/Admin');
		}
		$data = [
			'title' 		=> 'Kantor Hukum UNS',
			'slider'		=> $this->slider->getSlider(),
			'pengumuman'	=> $this->pengumuman->getPengumuman(),
		];

		return view('/user/Home/Home', $data);
	}

	// View Daftar Tampilan Produk Hukum Organisasi
	public function produkHukum()
	{
		// $this->cekBerlaku();
		$kategori = $this->kategori->getKategoriDokumen();
		$data = [
			'title' 	=> 'Produk Hukum UNS',
			'dokumen' 	=> $this->dokumen->getDokumen(),
			'kategori'	=> $kategori,
			'jml_kategori' => count($kategori)
		];
		$i = 1;
		foreach ($kategori as $value) {
			$data['data' . $i++] = $this->dokumen->getDokumenByKategori($value['id_kategori_dokumen']);
		}

		return view('/user/produkHukum/ProdukHukum', $data);
	}
	// Detail Produk Hukum
	public function detail($id)
	{
		$data = [
			'title'  => 'Detail Dokumen',
			'dokumen' => $this->dokumen->getDokumen($id)
		];
		return view('/user/Dokumen/details', $data);
	}
	// Download Produk Hukum
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
	// View Daftar Template Kantor Hukum
	public function template()
	{
		$data = [
			'title' 	=> 'Produk Hukum UNS',
			'template' 	=> $this->template->findAll(),
		];
		return view('/user/produkHukum/Template', $data);
	}
	// Download Template Untuk Produk Hukum 
	public function downloadTemplate($id)
	{
		$data = $this->template->find($id);
		$file = ('dokumen/template/' . $data['file']);
		if (file_exists($file)) {
			return $this->response->download($file, null);
		} else {
			session()->setFlashdata('danger', 'File Tidak Ditemukan Harap Melapor Ke Admin');
			return redirect()->to('/Template');
		}
	}

	// View Halaman Profil
	public function profil()
	{
		$data = [
			'title' 	=> 'Profil Kantor Hukum UNS',
			'info'	=> $this->informasi->getInfo(),
		];
		return view('/user/informasi/profil', $data);
	}
	// View Halaman Tugas Pokok
	public function tugasPokok()
	{
		$data = [
			'title' 	=> 'Tugas Pokok Kantor Hukum UNS',
			'info'	=> $this->informasi->getInfo(),
		];
		return view('/user/informasi/tugasPokok', $data);
	}
	// View Struktur Organisasi
	public function struktur()
	{
		$data = [
			'title' 	=> 'Struktur Organisasi Kantor Hukum UNS',
			'struktur'	=> $this->struktur->getStruktur(),
		];
		return view('/user/informasi/struktur', $data);
	}

	//view Pengumuman / Feeds
	public function pengumuman()
	{
		$data = [
			'title' 	 => 'Pengumuman Kantor Hukum UNS',
			'pengumuman' => $this->pengumuman->getPengumuman(),

		];
		// dd($data);
		return view('/user/Pengumuman/index', $data);
	}
	public function detailPengumuman($id)
	{
		$dataSlider = $this->pengumuman->getPengumuman($id);
		$data = [
			'title' 	 => $dataSlider['judul'],
			'value' 	 => $dataSlider,
			'pengumuman' => $this->pengumuman->getPengumuman(),
		];
		// dd($data);
		return view('/user/Pengumuman/detail', $data);
	}

	// view sop legal draft 
	public function sopLegalDraft()
	{
		$aktivitas = [
			[
				'aktivitas' => 'Aktivitas 1',
				'isi'		=> 'Pimpinan unit kerja mengajukan permohonan Legal Drafting kepada Kepala Kantor Hukum'
			],
			[
				'aktivitas' => 'Aktivitas 2',
				'isi'		=> 'Staf agendaris SIKD mendisposisi surat ajuan permohonan Legal Drafting keputusan dan/atau peraturan ke Kepala Kantor Hukum'
			],
			[
				'aktivitas' => 'Aktivitas 3',
				'isi'		=> 'Kepala Kantor Hukum setuju/tidak setuju/meminta pertimbangan kepada pimpinan/unit terkait yang kompeten tentang ajuan permohonan Legal Drafting keputusan dan/atau peraturan'
			],
			[
				'aktivitas' => 'Aktivitas 4',
				'isi'		=> 'Kepala Kantor Hukum mendisposisi surat ajuan permohonan Legal Drafting keputusan dan/atau peraturan ke Subkoordinator Subbagian Kantor Hukum untuk menyiapkan Legal Drafting'
			],
			[
				'aktivitas' => 'Aktivitas 5',
				'isi'		=> 'Subkoordinator Subbagian Kantor Hukum mendesposisi kepada staf Kantor Hukum untuk menyiapkan Legal Drafting'
			],
			[
				'aktivitas' => 'Aktivitas 6',
				'isi'		=> 'Staf Kantor Hukum mengirimkan soft file Draft Legal Drafting kepada Subkoordinator Subbagian Kantor Hukum untuk dikoreksi/review kembali. Setelah itu dimintakan review kembali kepada Kepala Kantor Hukum'
			],
			[
				'aktivitas' => 'Aktivitas 7',
				'isi'		=> 'Kepala Kantor Hukum memberi paraf Legal Drafting dan melalui staf agendaris SIKD mendisposisi surat ajuan permohonan Legal Drafting keputusan dan/atau peraturan ke Rektor melalui WR1/WR2/WR3/WR4/Sekretaris Rektor untuk dimintakan tanda tangan'
			],
			[
				'aktivitas' => 'Aktivitas 8',
				'isi'		=> 'Staf Kantor Hukum memberi nomor dan membuatkan Salinan Keputusan/Peraturan yang telah ditandatangani Rektor, kemudian menggandakan keputusan dan/ peraturan yang sudah ditanda tangani rektor untuk selanjutnya didistribusikan ke unit pengusul (Fakultas dan/ Unit Kerja lainnya) melalui SIKD'
			],
			[
				'aktivitas' => 'Aktivitas 9',
				'isi'		=> 'Staf mengarsipkan Keputusan dan Peraturan Rektor yang sudah selesai'
			],

		];
		$data = [
			'title' 	 => 'SOP LEGAL DRAFT KANTOR HUKUM UNS',
			'aktivitas'  => $aktivitas,

		];
		// dd($aktivitas);
		// dd($data);
		return view('/user/Legaldraft/LegalDraft', $data);
	}
}
