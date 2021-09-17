<?php

namespace App\Models;

use CodeIgniter\Model;

class Dokumen extends Model
{
	protected $table                = 'tbl_dokumen';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['tahun', 'judul', 'status', 'dokumen', 'no', 'id_kategori_dokumen', 'berlaku', 'sampai'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	public function getDokumen($id = false)
	{
		if ($id == false) {
			return $this
				->join('tbl_kategori_dokumen', 'tbl_dokumen.id_kategori_dokumen = tbl_kategori_dokumen.id_kategori_dokumen')
				->orderBy('tbl_dokumen.tahun', 'DESC')
				->orderBy('CAST(no AS DECIMAL) ASC')
				->get()->getResultArray();
		} else {
			return $this
				->join('tbl_kategori_dokumen', 'tbl_dokumen.id_kategori_dokumen = tbl_kategori_dokumen.id_kategori_dokumen')
				->where('tbl_dokumen.id=', $id)
				->first();
		}
	}
	public function getDokumenByKategori($kategori)
	{
		return $this
			->join('tbl_kategori_dokumen', 'tbl_dokumen.id_kategori_dokumen = tbl_kategori_dokumen.id_kategori_dokumen')
			->where('tbl_dokumen.id_kategori_dokumen=', $kategori)
			->orderBy('tbl_dokumen.tahun', 'DESC')
			->orderBy('CAST(no AS DECIMAL) ASC')
			->findAll();
	}
}
