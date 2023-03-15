<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFunction extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id_function" => ["type" => "INT", "constraint" => 11, "null" => false, "auto_increment" => true,],
			"id_framework" => ["type" => "INT", "constraint" => 11, "null" => false,],
			"id_method" => ["type" => "INT", "constraint" => 11, "null" => false,],
			"route" => ["type" => "VARCHAR", "constraint" => 100, "null" => false,],
		]);
		$this->forge->addPrimaryKey('id_function', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('function', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('function', true);
	}
}
