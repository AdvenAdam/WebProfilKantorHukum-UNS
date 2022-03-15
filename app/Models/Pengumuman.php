<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengumuman extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_pengumuman';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'id', 'judul', 'gambar', 'isi', 'creator',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	public function getPengumuman($id = null)
	{
		if ($id == null) {
			return $this->orderBy('created_at', 'DESC')->findAll();
		} else {
			return $this->find($id);
		}
	}

	public function getMaxId()
	{
		$idMax = $this
			->select('MAX(id) as id')
			->get()
			->getRow()->id;
		$con = $this
			->where('id', $idMax)
			->get()
			->getRow();
		return $con;
	}
}
