<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Herarki;
use App\Models\Peraturan;
use App\Models\Pegawai;

class SkController extends BaseController
{
	protected $herarki, $peraturan, $pegawai;
	function __construct()
	{
		$this->herarki = new Herarki();
		$this->peraturan = new Peraturan();
		$this->pegawai = new Pegawai();
	}
	public function index()
	{
		$data = [
			'title' => 'SK',
			'active' => 'sk',
			'herarki' => $this->herarki->getHerarki(),
			'peraturan' => $this->peraturan->getPeraturan(),
			'pegawai' => $this->pegawai->getPegawai(),
			'submenu' => '',
			'validation' =>  \Config\Services::validation()
		];
		return view('admin/sk/sk', $data);
	}
	public function save()
	{
		$lampiran_employ = [
			'id'			=> $this->request->getVar('lampiran_employ[]'),
			'data'  		=> $this->pegawai->ambilData($this->request->getVar('lampiran_employ[]')),
			'keterangan'	=> $this->request->getVar('ketuns[]')
		];
		$lampiran_student = [
			'nama'			=> $this->request->getVar('nama[]'),
			'nim'			=> $this->request->getVar('nim[]'),
			'prodi' 		=> $this->request->getVar('prodi[]'),
			'keterangan' 	=> $this->request->getVar('ketsiswa[]'),
		];
		$id_peg = $this->request->getVar('penandatangan');
		$data = [
			'tentang' 			=> $this->request->getVar('tentang'),
			'penandatangan' 	=> $this->pegawai->getPegawai($id_peg),
			'menimbang' 		=> $this->request->getVar('menimbang[]'),
			'mengingat' 		=> $this->peraturan->urutan($this->request->getVar('mengingat[]')),
			'memutuskan'	 	=> $this->request->getVar('memutuskan[]'),
			'lampiran_employ'  	=> $lampiran_employ,
			'lampiran_student'  => $lampiran_student,
			'ket_student' 		=> $this->request->getVar('keterangan_siswa'),
			'ket_employ' 		=> $this->request->getVar('keterangan_uns'),
		];
		return view('admin/sk/index', $data);
	}
	public function sortingPeraturan()
	{
	}
}
