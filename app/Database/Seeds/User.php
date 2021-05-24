<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
	public function run()
	{
		$user = [
			[
				'username' 		=> 'Paris Hartati',
				'email'		=> 'pariati@gmail.com',
				'password'	=> password_hash('123456789', PASSWORD_BCRYPT),
				'foto'		=> 'default.jpg',

			],
			[
				'username' 		=> 'Cemeti Putra',
				'email'		=> 'cemetra@gmail.com',
				'password'	=> password_hash('123456789', PASSWORD_BCRYPT),
				'foto'		=> 'default.jpg',
			],
			[
				'username' 		=> 'Baktiadi Saputra',
				'email'		=> 'baktiatra@gmail.com',
				'password'	=> password_hash('123456789', PASSWORD_BCRYPT),
				'foto'		=> 'default.jpg',
			],
		];

		$this->db->table('tbl_user')->insertBatch($user);
	}
}
