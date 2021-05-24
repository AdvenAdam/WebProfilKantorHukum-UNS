<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kategori extends Seeder
{
	public function run()
	{
		$kategori = ['Peraturan MWA', 'Peraturan Rektor', 'Keputusan Rektor'];
		foreach ($kategori as $key => $value) {
			$data = [
				'kategori_dokumen'	=> $value
			];
			$this->db->table('tbl_kategori_dokumen')->insert($data);
		}
	}
}
