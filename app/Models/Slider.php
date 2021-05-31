<?php

namespace App\Models;

use CodeIgniter\Model;

class Slider extends Model
{
	protected $table                = 'tbl_slider';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['judul', 'subjudul', 'keterangan', 'foto', 'link'];

	public function getSlider($id = null)
	{
		if ($id == null) {
			return $this->findAll();
		} else {
			return $this->find($id);
		}
	}
}
