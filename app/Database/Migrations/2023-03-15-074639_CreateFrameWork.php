<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFrameWork extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id_framework" => ["type" => "INT", "constraint" => 11, "null" => false, "auto_increment" => true,],
			"name_framework" => ["type" => "VARCHAR", "constraint" => 100, "null" => false,],
			"id_lang" => ["type" => "INT", "constraint" => 11, "null" => false,],
		]);
		$this->forge->addPrimaryKey('id_framework', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('framework', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('framework', true);
	}
}
