<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanNomor extends Model
{

	protected $table                = 'tbl_pengajuannomor';
	protected $useAutoIncrement     = true;
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['id', 'no_dokumen', 'kategori', 'pengusul', 'tahun', 'tanggal_ditetapkan', 'perihal'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'date';



	public function getData($id = null)
	{
		if ($id == null) {
			return $this->orderBy('tanggal_ditetapkan', 'desc')->orderBy('CAST(no_dokumen AS DECIMAL) ASC')->findAll();
		} elseif ($id == 'recent') {
			return $this->orderBy('CAST(id AS DECIMAL)desc')->findAll();
		} else {
			return $this->find($id);
		}
	}

	public function getYear()
	{
		return $this->distinct()->select('tahun')->find();
	}
}
