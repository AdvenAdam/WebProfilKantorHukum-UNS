<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenInternal extends Model
{

	protected $table                = 'tbl_dokumen_internal';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['tahun', 'judul', 'file', 'no_sk','status'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'date';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	public function getDok_internal($id = false)
	{
		if ($id == false) {
			return $this
				->orderBy('tahun DESC')
				->orderBy('no_sk ASC')
				->findAll();
		} else {
			return $this
				->where('tbl_dokumen_internal.id', $id)
				->first();
		}
	}
}
