<?php

namespace App\Models;

use CodeIgniter\Model;

class StrukturOrganisasi extends Model
{
	protected $table                = 'tbl_strukturorganisasi';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['struktur_organisasi', 'id'];

	public function getStruktur($id = null)
	{
		if ($id == null) {
			return $this->findAll();
		} else {
			return $this->find($id);
		}
	}
}
