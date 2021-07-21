<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Herarki;
use App\Models\Peraturan;
use App\Models\Pegawai;
use App\Models\SkAngkatBerhenti;

class SkController extends BaseController
{
	protected $herarki, $peraturan, $pegawai, $sk;
	function __construct()
	{
		$this->herarki 		= new Herarki();
		$this->peraturan 	= new Peraturan();
		$this->pegawai 		= new Pegawai();
		$this->sk			= new SkAngkatBerhenti();
	}
	public function index()
	{

		$data = [
			'title' 		=> 'SK',
			'active' 		=> 'sk',
			'sk'			=> $this->sk->getSk(),
			'submenu' 		=> '',
			'validation' 	=>  \Config\Services::validation()
		];
		// dd($data['sk']);
		return view('admin/sk/index', $data);
	}

	public function create()
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
		// dd($data);
		return view('admin/sk/input', $data);
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
			'penandatangan' 	=> json_encode($this->pegawai->getPegawai($id_peg)),
			'menimbang' 		=> json_encode($this->request->getVar('menimbang[]')),
			'mengingat' 		=> json_encode($this->peraturan->urutan($this->request->getVar('mengingat[]'))),
			'memutuskan'	 	=> json_encode($this->request->getVar('memutuskan[]')),
			'lampiran_employ'  	=> json_encode($lampiran_employ),
			'lampiran_student'  => json_encode($lampiran_student),
			'ket_employ' 		=> $this->request->getVar('keterangan_uns'),
			'ket_student' 		=> $this->request->getVar('keterangan_siswa'),
		];
		$this->sk->save($data);
		session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
		return redirect()->to('/Admin/SK');
	}

	public function delete($id)
	{
		$this->sk->delete($id);
		session()->setFlashdata('success', 'Data Berhasil Dihapus');
		return redirect()->to('/Admin/SK');
	}

	public function edit($id)
	{
		$data = [
			'title' 		=> 'SK',
			'active' 		=> 'sk',
			'sk'			=> $this->sk->getSk($id),
			'herarki' => $this->herarki->getHerarki(),
			'peraturan' => $this->peraturan->getPeraturan(),
			'pegawai' => $this->pegawai->getPegawai(),
			'submenu' 		=> '',
			'validation' 	=>  \Config\Services::validation()
		];
		return view('admin/sk/edit', $data);
	}
	public function update($id)
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
			'id'				=> $id,
			'tentang' 			=> $this->request->getVar('tentang'),
			'penandatangan' 	=> json_encode($this->pegawai->getPegawai($id_peg)),
			'menimbang' 		=> json_encode($this->request->getVar('menimbang[]')),
			'mengingat' 		=> json_encode($this->peraturan->urutan($this->request->getVar('mengingat[]'))),
			'memutuskan'	 	=> json_encode($this->request->getVar('memutuskan[]')),
			'lampiran_employ'  	=> json_encode($lampiran_employ),
			'lampiran_student'  => json_encode($lampiran_student),
			'ket_employ' 		=> $this->request->getVar('keterangan_uns'),
			'ket_student' 		=> $this->request->getVar('keterangan_siswa'),
		];
		$this->sk->save($data);
		session()->setFlashdata('success', 'Data Berhasil Diubah');
		return redirect()->to('/Admin/SK');
	}

	public function detail($id)
	{
		$data = [
			'title' 		=> 'Detail SK',
			'active' 		=> 'sk',
			'sk'			=> $this->sk->getSk($id),
			'submenu' 		=> '',
			'cetak'			=> false
		];
		return view('admin/sk/temp_sk', $data);
	}
	public function cetak($id)
	{
		$data = [
			'title' 		=> 'Cetak SK',
			'active' 		=> 'sk',
			'sk'			=> $this->sk->getSk($id),
			'submenu' 		=> '',
			'cetak'			=> true
		];
		return view('admin/sk/temp_sk', $data);
	}
}
