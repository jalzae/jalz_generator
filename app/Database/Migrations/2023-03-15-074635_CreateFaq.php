<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFaq extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id_faq" => ["type" => "INT", "constraint" => 11, "null" => false, "auto_increment" => true,],
			"version_name" => ["type" => "VARCHAR", "constraint" => 200, "null" => false,],
			"desc_update" => ["type" => "TEXT", "null" => false,],
			"entry_user" => ["type" => "VARCHAR", "constraint" => 100, "null" => false,],
			"entry_date" => ["type" => "DATETIME", "null" => false,],
		]);
		$this->forge->addPrimaryKey('id_faq', true);
		$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('faq', false, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('faq', true);
	}
}
