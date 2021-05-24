<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblKategoriDokumen extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_kategori_dokumen'	=> [
				'type'				=> 'int',
				'constraint'		=> 10,
				'auto_increment'	=> true,
				'unsigned'   => true
			],
			'kategori_dokumen'	=> [
				'type'				=> 'varchar',
				'constraint'		=> 50
			]
		]);

		$this->forge->addKey('id_kategori_dokumen', true);
		$this->forge->createTable('tbl_kategori_dokumen');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_kategori_dokumen');
	}
}
