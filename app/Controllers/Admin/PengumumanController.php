<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Pengumuman;
use App\Models\Slider;
use Config\Validation;
use PhpParser\Node\Stmt\If_;

class PengumumanController extends BaseController
{
	protected $pengumuman, $slider;
	function __construct()
	{
		$this->pengumuman = new Pengumuman();
		$this->slider = new Slider();
	}

	public function index()
	{
		$data = [
			'title' => 'Halaman Pengumuman',
			'pengumuman' => $this->pengumuman->getPengumuman(),
			'active'	=> 'info',
			'submenu'	=> 'pengumuman',
			'validation' => \Config\Services::validation()
		];
		return view('admin/pengumuman/index', $data);
	}
	public function edit($id)
	{
		$dataJudul = $this->pengumuman->find($id);
		$dataSlider = $this->slider->triggerDelete($dataJudul['judul'], format_indo($dataJudul['created_at']));

		if ($dataSlider != null) {
			$checked = 'true';
		} else {
			$checked = '';
		}
		$data = [
			'title' => 'Halaman Pengumuman',
			'pengumuman' => $dataJudul,
			'active'	=> 'info',
			'submenu'	=> 'pengumuman',
			'centang'	=> $checked,
			'validation' => \Config\Services::validation()
		];
		return view('admin/pengumuman/edit', $data);
	}
	public function validationRule($rule = 'save')
	{
		if ($rule == 'save') {
			$validation = [
				'judul' => [
					'rules' => 'required|is_unique[tbl_pengumuman.judul]',
					'label' => 'Judul',
					'errors' => [
						'required' => '{field} Harus Diisi',
						'is_unique' => '{field} Sudah Ada'
					]
				],
				'creator' => [
					'rules' => 'required',
					'label' => 'Status',
					'errors' => [
						'required' => '{field} Harus Diisi'
					]
				],
				'isi' => [
					'rules' => 'required',
					'label' => 'Tahun',
					'errors' => [
						'required' => '{field} Harus Diisi'
					]
				],
				'gambar' => [
					'rules' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
					'errors' => [
						'is_image' => 'File yang diupload harus berupa foto',
						'mime_in'  => 'File yang diupload harus berformat jpg/jpeg/png',
					]
				],
			];
		} else {
			$validation = [
				'judul' => [
					'rules' => 'required',
					'label' => 'Judul',
					'errors' => [
						'required' => '{field} Harus Diisi',
					]
				],
				'creator' => [
					'rules' => 'required',
					'label' => 'Status',
					'errors' => [
						'required' => '{field} Harus Diisi'
					]
				],
				'isi' => [
					'rules' => 'required',
					'label' => 'Tahun',
					'errors' => [
						'required' => '{field} Harus Diisi'
					]
				],
				'gambar' => [
					'rules' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
					'errors' => [
						'is_image' => 'File yang diupload harus berupa foto',
						'mime_in'  => 'File yang diupload harus berformat jpg/jpeg/png',
					]
				],
			];
		}
		return $validation;
	}
	public function save()
	{
		// validasi input
		if (!$this->validate($this->validationRule('save'))) {
			session()->setFlashdata('danger', 'Pastikan Mengisikan data dengan benar');
			return redirect()->to(base_url('/Admin/Pengumuman'))->withInput();
		}
		// mengambil data dari input
		$judul = $this->request->getVar('judul');
		$isi = $this->request->getVar('isi');
		$gambar = $this->request->getFile('gambar');
		$cek = $this->request->getVar('cekToSlider');
		// upload file
		if ($gambar->getError() == 4) {
			$judulGambar = 'default.jpg';
		} else {
			$judulGambar = $gambar->getRandomName();
			$gambar->move('image/pengumuman', $judulGambar);
			if ($cek != null) {
				copy('image/pengumuman/' . $judulGambar, 'image/slider/' . $judulGambar);
			}
		}
		$data = [
			'judul' => $judul,
			'gambar' => $judulGambar,
			'isi'	=> $isi,
			'creator' => session()->user_name
		];
		$this->pengumuman->save($data);
		// mendapatkan id terakhir dr data pengumuman
		$d_pengumuman = $this->pengumuman->getMaxId();
		if ($cek != null) {
			$dataSlider = [
				'judul' => 'Kantor Hukum',
				'keterangan' => $judul,
				'link' => '/Pengumuman' . '/' . $d_pengumuman->id,
				'foto' => $judulGambar,
				'subjudul' => format_indo($d_pengumuman->created_at),
			];
			$this->slider->save($dataSlider);
		}
		session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
		return redirect()->to('/Admin/Pengumuman');
	}
	public function delete($id)
	{
		$data = $this->pengumuman->find($id);
		// mendapatkan data dari tbl slidder
		$dataSlider = $this->slider->triggerDelete($data['judul'], format_indo($data['created_at']));
		// dd($dataSlider);
		if ($dataSlider != null) {
			$lokasiSlider  = ('image/slider/' . $dataSlider->foto);
		}
		$lokasi  = ('image/pengumuman/' . $data['gambar']);
		if ($data['gambar'] != 'default.jpg' && file_exists($lokasi)) {
			// dd('Bisa ha[us');
			unlink($lokasi);
		}
		if ($dataSlider != null) {
			if ($dataSlider->foto != 'default.jpg' && file_exists($lokasiSlider)) {
				unlink($lokasiSlider);
			}
			$this->slider->delete($dataSlider->id);
		}
		$this->pengumuman->delete($data['id']);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/Pengumuman');
	}
	public function update($id)
	{
		if (!$this->validate($this->validationRule('edit'))) {
			return redirect()->to(base_url('/Admin/Pengumuman/edit/' . $id))->withInput();
		}
		// get data from form edir
		$judul 	= $this->request->getVar('judul');
		$isi 	= $this->request->getVar('isi');
		$gambar = $this->request->getFile('gambar');
		$cek 	= $this->request->getVar('cekToSlider');
		// get data lama dari pengumuman dan slider
		$dataPengumumanLama = $this->pengumuman->getPengumuman($id);
		$dataSliderLama 	= $this->slider->triggerDelete($dataPengumumanLama['judul'], format_indo($dataPengumumanLama['created_at']));
		// dd($dataSliderLama);
		// pemrosesan update gambar untuk bagian pengumuman  
		if ($gambar->getError() == 4) {
			$judulGambar = $dataPengumumanLama['gambar'];
		} else {
			$judulGambar = $gambar->getRandomName();
			$gambar->move('image/pengumuman', $judulGambar);
			if ($dataPengumumanLama['gambar'] != 'default.jpg') {
				unlink('image/pengumuman/' . $dataPengumumanLama['gambar']);
			}
		}
		$dataPengumuman = [
			'id'		=> $id,
			'judul' 	=> $judul,
			'gambar'	=> $judulGambar,
			'isi'		=> $isi,
			'creator' 	=> session()->user_name
		];
		$this->pengumuman->save($dataPengumuman);

		// jika checkbox di panel edit di centang 
		if ($cek != null) {
			// jika sebelumnya di tabel slider belum terdapat data
			if ($dataSliderLama == null) {
				// menambahkan data ke slider
				$dataSlider = [
					'judul' 		=> 'Kantor Hukum',
					'keterangan' 	=> $judul,
					'link' 			=> '/Pengumuman' . '/' . $id,
					'foto' 			=> $judulGambar,
					'subjudul'	 	=> format_indo($dataPengumumanLama['created_at']),
				];
				if ($judulGambar != 'default.jpg') {
					copy('image/pengumuman/' . $judulGambar, 'image/slider/' . $judulGambar);
				}
				$this->slider->save($dataSlider);
			} else {
				// Update di kedua tabel
				$dataSlider = [
					'id'		 => $dataSliderLama->id,
					'judul' 	 => 'Kantor Hukum',
					'keterangan' => $judul,
					'link' 		 => '/Pengumuman' . '/' . $id,
					'foto'		 => $judulGambar,
					'subjudul' 	 => format_indo($dataPengumumanLama['created_at']),
				];
				if ($judulGambar != 'default.jpg' && $dataSliderLama->foto != $dataPengumumanLama['gambar']) {
					copy('image/pengumuman/' . $judulGambar, 'image/slider/' . $judulGambar);
				}
			}
		}
		// jika check box di panel edit dihilangkan centangnya
		if ($cek == null && $dataSliderLama != null) {
			// menghapus data di tabel slider 
			$lokasiSlider  = ('image/slider/' . $dataSliderLama->foto);
			if ($dataSliderLama->foto != 'default.jpg' && file_exists($lokasiSlider)) {
				unlink($lokasiSlider);
			}
			$this->slider->delete($dataSliderLama->id);
		}
		session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
		return redirect()->to('/Admin/Pengumuman');
	}
}
