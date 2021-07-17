<?php

namespace App\Models;

use CodeIgniter\Model;

class Peraturan extends Model
{
	protected $table                = 'tbl_peraturan';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['nomor', 'id_herarki', 'tahun', 'detail'];

	public function getPeraturan($id = null)
	{
		if ($id == null) {
			return $this
				->select('tbl_peraturan.id as id,herarki, id_herarki, nomor, tahun, detail')
				->join('tbl_herarki', 'tbl_peraturan.id_herarki = tbl_herarki.id')
				->get()->getResultArray();
		} else {
			return $this
				->select('tbl_peraturan.id as id,herarki, id_herarki, nomor, tahun, detail')
				->join('tbl_herarki', 'tbl_peraturan.id_herarki = tbl_herarki.id')
				->where('tbl_peraturan.id=', $id)
				->get()->getResultArray();
		}
	}
	public function urutan($array)
	{
		if ($array == null) {
			return null;
		} else {
			return $this
				->select('tbl_peraturan.id as id,herarki, id_herarki,urutan, nomor, tahun, detail')
				->join('tbl_herarki', 'tbl_peraturan.id_herarki = tbl_herarki.id')
				->orderBy('urutan ASC, tahun ASC, nomor ASC')
				->find($array);
		}
	}
}
