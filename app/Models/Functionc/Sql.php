<?php

namespace App\Models\Functionc;

use CodeIgniter\Model;

class Sql extends Model
{
	public function resultSqlCreate($array, $table, $option = [])
	{
		echo 'CREATE TABLE `' . $table . '` (';
		$primarykey = "";
		foreach ($array as $obj) {
			echo '`' . $obj['name'] . '`';

			//Define type
			if ($obj['type'] == "uuid") {
				echo "CHAR(36)";
			} else if ($obj['type'] == "string") {
				echo "VARCHAR(" . $obj['contraits'] . ")";
			} else if ($obj['type'] == "varchar") {
				echo "VARCHAR(" . $obj['contraits'] . ")";
			} else if ($obj['type'] == "int" && $obj['primmary_key'] == "true") {
				echo "INT";
			} else if ($obj['type'] == "int" && $obj['primmary_key'] != "true") {
				echo "INT(" . $obj['contraits'] . ")";
			} else if ($obj['type'] == "bool") {
				echo "TINYINT(1)";
			} else if ($obj['type'] == "datetime") {
				echo "DATETIME";
			}



			//Define Null or not 
			if ($obj['null'] == "true") {
				echo ' NULL ';
			} else {
				echo ' NOT NULL ';
			}

			//Define Default Value or not 
			if ($obj['default'] != "false") {
				echo " DEFAULT " . $obj['default'];
			}

			//Define primary key 
			if ($obj['primmary_key'] == "true") {
				$primarykey = $obj['name'];
			}

			//Define Comment Value or not 
			if ($obj['comment'] != "false") {
				echo " COMMENT '" . $obj['comment'] . "'";
			}

			echo ",
			";
		}
		echo ' PRIMARY KEY (`' . $primarykey . '`)';
		echo ') ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;';
	}
}
