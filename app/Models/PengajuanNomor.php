<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanNomor extends Model
{

	protected $table                = 'tbl_pengajuannomor';
	protected $useAutoIncrement     = true;
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['id', 'no_dokumen', 'kategori', 'tahun', 'tanggal_dokumen', 'perihal'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'date';



	public function getPengajuan($id = null)
	{
		if ($id == null) {
			return $this->findAll();
		} else {
			return $this->find($id);
		}
	}
}
