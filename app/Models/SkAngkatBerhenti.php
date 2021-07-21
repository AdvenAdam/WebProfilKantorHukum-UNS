<?php

namespace App\Models;

use CodeIgniter\Model;

class SkAngkatBerhenti extends Model
{
	protected $table                = 'tbl_sk';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['tentang', 'penandatangan', 'menimbang', 'mengingat', 'memutuskan', 'lampiran_employ', 'lampiran_student', 'ket_employ', 'ket_student'];
	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	public function getSk($id = null)
	{
		if ($id == null) {
			return $this->findAll();
		} else {
			return $this->find($id);
		}
	}
}
