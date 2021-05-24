<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokumen extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'	=> [
				'type'				=> 'int',
				'constraint'		=> 10,
				'auto_increment'	=> true,
				'unsigned'   => true
			],
			'tahun'		=> [
				'type'		=> 'varchar',
				'constraint' => 5
			],
			'judul'	=> [
				'type'		=> 'text',
			],
			'status'	=> [
				'type'		=> 'ENUM',
				'constraint' => ['berlaku', 'tidak berlaku'],
				'default'	=> 'berlaku'
			],
			'id_kategori_dokumen' =>
			[
				'type'		=> 'int',
				'constraint' => 10,
				'unsigned'   => true
			],
			'dokumen' =>
			[
				'type'		=> 'varchar',
				'constraint' => 255,
				'null' => true,
			],

			'berlaku' =>
			[
				'type'	=> 'date'
			],
			'sampai' =>
			[
				'type'	=> 'date'
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
		// $this->forge->addForeignKey('id_kategori_dokumen', 'tbl_kategori_dokumen', 'id_kategori_dokumen', 'no action', 'no action');
		$this->forge->createTable('tbl_dokumen');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_dokumen');
	}
}
