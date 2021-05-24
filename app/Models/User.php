<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
	protected $table                = 'tbl_user';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['username', 'email', 'password', 'foto'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	public function getUser($id = false)
	{
		if ($id == false) {
			return $this->findAll();
		} else {
			return $this->find($id);
		}
	}
}
