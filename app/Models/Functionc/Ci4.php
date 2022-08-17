<?php

namespace App\Models\Functionc;

use CodeIgniter\Model;

class Ci4 extends Model
{
	public function resultMigrateCreate($array, $table, $option = [])
	{
		$primmaryKey = "";
		echo 'public function up() {';
		echo '$fields=[';
		foreach ($array as $obj) {
			echo '"' . $obj['name'] . '"=>[';
			echo '"type" =>"' . strtoupper(strtok($obj['type'], '(')) . '",';

			if ($obj['type'] != 'datetime' || $obj['type'] != 'uuid' || $obj['type'] != 'bool') {
				if ($obj['contraits'] != 0) {
					echo
					'"constraint" =>' . $obj['contraits'] . ',';
				}
			}

			if ($obj['null'] == "false") {
				echo '"null" =>false,';
			} else {
				echo '"null" =>true,';
			}

			if ($obj['default'] != "false") {
				if ($obj['type'] != "datetime") {
					echo '"default" =>"' . $obj['default'] . '",';
				}
			}

			if ($obj['auto_increment'] != 'false') {
				echo '"auto_increment" =>true';
			}

			if ($obj['primmary_key'] != 'false') {
				$primmaryKey = $obj['name'];
			}
			echo '],
    	';
		}
		echo '];';

		echo '$this->forge->addField($fields);';

		echo '$this->forge->addPrimaryKey("' . $primmaryKey . '", true);';
		echo '$attributes = ["ENGINE" => "InnoDB"];';
		echo '$this->forge->createTable("' . $table . '", false, $attributes);';
		echo '}
		';

		echo 'public function down() {';
		echo '
		return $this->db->query("DROP TABLE `' . $table . '`");
		';
		echo '}';
	}
}
