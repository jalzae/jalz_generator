<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLang extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id_lang" => ["type" => "INT", "constraint" => 11, "null" => false, "auto_increment" => true,],
			"name_lang" => ["type" => "VARCHAR", "constraint" => 100, "null" => false,],
		]);
		$this->forge->addPrimaryKey('id_lang', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('lang', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('lang', true);
	}
}
