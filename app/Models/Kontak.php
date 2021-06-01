<?php

namespace App\Models;

use CodeIgniter\Model;

class Kontak extends Model
{
	protected $table                = 'tbl_kontak';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['nama', 'email', 'phone', 'subject', 'pesan'];

	public function getKontak($id = null)
	{
		if ($id == null) {
			return $this->findAll();
		} else {
			return $this->find($id);
		}
	}
}
