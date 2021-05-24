<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'	=> [
				'type'				=> 'int',
				'contraint'			=> 10,
				'auto_increment'	=> true
			],
			'username'	=> [
				'type'		=> 'varchar',
				'constraint' => 100
			],
			'email'	=> [
				'type'		=> 'varchar',
				'constraint' => 75
			],
			'password' => [
				'type'		=> 'varchar',
				'constraint' => 225
			],
			'foto'	 => [
				'type'		=> 'varchar',
				'constraint' => 225
			],
			'created_at' =>
			[
				'type'	=> 'date'
			],
			'updated_at' =>
			[
				'type'	=> 'date'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_user');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_user');
	}
}
