<?php

namespace App\Models;

use CodeIgniter\Model;

class Informasi extends Model
{
	protected $table                = 'tbl_informasi';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['profil', 'tugas_pokok'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	public function getInfo($id = false)
	{
		if ($id == false) {
			return $this->findAll();
		} else {
			return $this->find($id);
		}
	}
}
