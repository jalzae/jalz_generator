<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCss extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id_css" => ["type" => "INT", "constraint" => 11, "null" => false, "auto_increment" => true,],
			"name_css" => ["type" => "VARCHAR", "constraint" => 50, "null" => false,],
		]);
		$this->forge->addPrimaryKey('id_css', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('css', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('css', true);
	}
}
