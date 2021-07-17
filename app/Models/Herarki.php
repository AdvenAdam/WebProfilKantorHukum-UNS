<?php

namespace App\Models;

use CodeIgniter\Model;

class Herarki extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_herarki';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['herarki', 'urutan'];

	public function getHerarki($id = false)
	{
		if ($id == false) {
			return $this->orderBy('urutan')->findAll();
		}
		return $this->find($id);
	}
}
