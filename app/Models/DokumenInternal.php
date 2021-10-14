<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenInternal extends Model
{

	protected $table                = 'tbl_dokumen_internal';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['tahun', 'judul', 'file', 'no_sk', 'mulai', 'sampai', 'status_berlaku', 'status'];

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
				->orderBy('CAST(no_sk AS SIGNED) DESC')
				->findAll();
		} else {
			return $this
				->where('tbl_dokumen_internal.id', $id)
				->first();
		}
	}
	public function jumlahData($jenis)
	{
		if ($jenis == 'sk') {
			return $this
				->where('LENGTH(no_sk) > 4')
				->get()
				->getResultArray();
		} elseif ($jenis == 'perek') {
			return $this
				->where('LENGTH(no_sk) < 4')
				->get()
				->getResultArray();
		}
	}
}
