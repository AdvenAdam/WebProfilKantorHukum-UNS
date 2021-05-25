<?php

namespace App\Controllers;

use App\Models\Dokumen;

class Home extends BaseController
{
	protected $kategori, $dokumen;
	function __construct()
	{
		$this->dokumen = new Dokumen();
	}
	public function index()
	{

		return view('/auth/login');
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
