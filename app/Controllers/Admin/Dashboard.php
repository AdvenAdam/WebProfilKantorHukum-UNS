<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Dokumen;
use App\Models\User;
use App\Models\Kategori;

class Dashboard extends BaseController
{
	protected $dokumen, $user, $kategori;
	function __construct()
	{
		$this->dokumen = new Dokumen();
		$this->user = new User();
		$this->kategori = new Kategori();
	}
	public function index()
	{

		$data = [
			'jml_dokumen' 	=> count($this->dokumen->findAll()),
			'usertampil'	=> $this->user->orderBy('id', 'DESC')->get(3)->getResultArray(),
			'user'			=> $this->user->getUser(),
			'tahun'			=> $this->tahundok(),
			'status'		=> $this->status(),
			'kategori'		=> $this->kategori(),
			'title' 	    => 'Dashboard Admin',
			'side' 	        => 'dashboard'
		];
		// dd($this->status());
		return view('/Admin/Dashboard', $data);
	}

	public function kategori()
	{
		$kategori = $this->kategori->findAll();
		$newArray = array();
		foreach ($kategori as $key => $value) {
			$newArray[$key] = [
				'kategori' => $value['kategori_dokumen'],
				'jumlah' => count($this->dokumen->getDokumenByKategori($value['id_kategori_dokumen'])),
			];
		}

		return $newArray;
	}
	public function tahundok()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tbl_dokumen');
		$builder->select('tahun,count(tahun) as jumlah_data');
		$builder->groupBy('tahun');
		$query = $builder->get()->getResultArray();
		return $query;
	}
	public function status()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tbl_dokumen');
		$builder->select('status,count(status) as jumlah_data');
		$builder->groupBy('status');
		$query = $builder->get()->getResultArray();
		return $query;
	}
}
