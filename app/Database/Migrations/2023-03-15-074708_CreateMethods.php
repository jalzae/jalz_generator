<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMethods extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id_method" => ["type" => "INT", "constraint" => 11, "null" => false, "auto_increment" => true,],
			"name_method" => ["type" => "VARCHAR", "constraint" => 50, "null" => false,],
		]);
		$this->forge->addPrimaryKey('id_method', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('method', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('method', true);
	}
}
