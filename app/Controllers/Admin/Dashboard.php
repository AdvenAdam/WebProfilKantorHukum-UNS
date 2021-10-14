<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Dokumen;
use App\Models\DokumenInternal;
use App\Models\User;
use App\Models\Kategori;

class Dashboard extends BaseController
{
	protected $dokumen, $user, $kategori;
	function __construct()
	{
		$this->dokumen = new Dokumen();
		$this->dok_internal = new DokumenInternal();
		$this->user = new User();
		$this->kategori = new Kategori();
	}
	public function index()
	{

		$data = [
			'jml_dokumen' 	 		 => count($this->dokumen->findAll()),
			'jml_dokumen_intern' 	 => count($this->dok_internal->findAll()),
			'usertampil'			 => $this->user->orderBy('id', 'DESC')->get(3)->getResultArray(),
			'user'					 => $this->user->getUser(),
			'tahun'					 => $this->tahundok(),
			'tahunDokInternal' 		 => $this->tahunDokInternal(),
			'kategori_internal'		 => $this->kategori_internal(),
			'kategori'				 => $this->kategori(),
			'title' 	    		 => 'Dashboard Admin',
			'active' 	    		 => 'dashboard',
			'submenu'				 => '',
			'jumlahKategori'		 => count($this->kategori->findAll()),
		];
		return view('/admin/dashboard', $data);
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
	public function kategori_internal()
	{
		$sk = count($this->dok_internal->jumlahData('sk'));
		$perek = count($this->dok_internal->jumlahData('perek'));
		$kategori = [
			[
				'kategori' => 'SK',
				'jumlah' => $sk
			],
			[
				'kategori' => 'Peraturan Rektor',
				'jumlah' => $perek
			]
		];
		return $kategori;
	}
	public function tahunDokInternal()
	{
		return $this->dok_internal
			->select('tahun,count(tahun) as jumlah_data')
			->groupBy('tahun')
			->get()->getResultArray();
	}
}
