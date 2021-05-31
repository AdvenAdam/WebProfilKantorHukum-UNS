<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_kategori_dokumen';
	protected $primaryKey           = 'id_kategori_dokumen';
	protected $useAutoIncrement     = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['kategori_dokumen'];

	public function getKategoriDokumen($id = false)
	{
		if ($id == false) {
			return $this->findAll();
		}
		return $this->find($id);
	}
}
