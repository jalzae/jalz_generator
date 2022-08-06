<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Test extends Migration
{

	public function up()
	{
		$fields = [
			"id" => ["type" => "INT", "constraint" => "11", "null" => false, "auto_increment" => true],
			"name" => ["type" => "VARCHAR", "constraint" => "200", "null" => true,],
			"status_delete" => ["type" => "INT", "constraint" => "1", "null" => true,],
			"entry_date" => ["type" => "DATETIME", "null" => false,],
			"update_date" => ["type" => "DATETIME", "null" => false,],
			"delete_date" => ["type" => "DATETIME", "null" => true,],
			"entry_user" => ["type" => "VARCHAR", "constraint" => "200", "null" => false,],
			"update_user" => ["type" => "VARCHAR", "constraint" => "200", "null" => false,],
			"delete_user" => ["type" => "VARCHAR", "constraint" => "200", "null" => true,],
		];
		$this->forge->addField($fields);
		$this->forge->addPrimaryKey("id", true);
		$attributes = ["ENGINE" => "InnoDB"];
		$this->forge->createTable("table", false, $attributes);
	}
	public function down()
	{
		return $this->db->query("DROP TABLE `table`");
	}
}
