<?php

namespace App\Models;

use CodeIgniter\Model;

class Template extends Model
{
	protected $table                = 'tbl_template';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['judul', 'id', 'file'];
}
