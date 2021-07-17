<?php

namespace App\Models;

use CodeIgniter\Model;

class Pegawai extends Model
{
	protected $table                = 'tbl_employer_ex';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['nama', 'pangkatgol', 'nik'];

	public function getPegawai($id = null)
	{
		if ($id == null) {
			return $this->findAll();
		} else {
			return $this->find($id);
		}
	}
	public function ambilData($id = null)
	{
		if ($id == null) {
			return null;
		} else {
			return $this->find($id);
		}
	}
}
