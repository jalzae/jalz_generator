<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Functionc\Ci4;
use App\Models\Functionc\Sequelize;
use App\Models\Functionc\Sql;

class Command extends BaseController
{
	public function __construct()
	{

		$this->sequelize = new Sequelize();
		$this->ci4 = new Ci4();
		$this->sql = new Sql();
	}
	public function generate()
	{
		$json = $this->request->getVar('json');
		$cmd = $this->request->getVar('cmd');
		$data = explode(",", $json);
		$command = explode(" ", $cmd);
		$paranoid = false;
		if (empty($json)) {
			return "Hey its empty request body";
		}

		$checked = $this->checkarray($data);

		if (!is_array($checked)) {
			return $checked;
		}

		//Sequelize
		if ($command[0] == "Sequelize") {
			if ($command[1] == "migration") {
				if (empty($command[2])) {
					return "Name Migration result must be provided";
				}

				if (!empty($command[3])) {
					if ($command[3] == "paranoid") {
						$paranoid = true;
						$checked = $this->paranoid($checked);
					}
				}

				return $this->sequelize->resultSequelizeMigration($checked, $command[2]);
			}

			//Sequelize Model
			else if ($command[1] == "model") {
				if (empty($command[2])) {
					return "Name Model result must be provided";
				}
				return $this->sequelize->resultSequelizeModel($checked, $command[2], $paranoid);
			}

			//Sequelize Validation
			else if ($command[1] == "validation") {
				if (empty($command[2])) {
					return "Name Validation result must be provided";
				}
				return $this->sequelize->resultSequelizeModel($checked, $command[2]);
			}

			//Other error
			else {
				echo "Sequelize Methods not found";
			}
		}
		//Codeigniter4 
		else if ($command[0] == "Ci4") {
			if ($command[1] == "migration") {
				if (empty($command[2])) {
					return "Name Migration result must be provided";
				}

				if (!empty($command[3])) {
					if ($command[3] == "paranoid") {
						$checked = $this->paranoid($checked);
					}
				}

				return $this->ci4->resultMigrateCreate($checked, $command[2]);
			} else {
				return "This method is not exist dude";
			}
		}
		//Sql Function
		else if ($command[0] == "Sql") {

			if ($command[1] == "create") {

				if (empty($command[2])) {
					return "Name Table result must be provided";
				}

				if (!empty($command[3])) {
					if ($command[3] == "paranoid") {
						$checked = $this->paranoid($checked);
					}
				}
				return $this->sql->resultSqlCreate($checked, $command[2]);
			} else {
				echo "Sql Methods not found";
			}
		} else {
			echo "Methods not found";
		}
	}

	public function checkarray($array)
	{
		$result = [];
		foreach ($array as $obj) {
			$exploded = explode(":", $obj);
			$name = trim($exploded[0]);

			if (trim($exploded[1]) == "string" || trim($exploded[1]) == "int" || trim($exploded[1]) == "float" || trim($exploded[1]) == "uuid" || trim($exploded[1]) == "dec" || trim($exploded[1]) == "enum" || trim($exploded[1]) == "varchar" || trim($exploded[1]) == "char" || trim($exploded[1]) == "bool" || trim($exploded[1]) == "date" || trim($exploded[1]) == "datetime" || trim($exploded[1]) == "time" || trim($exploded[1]) == "text" || trim($exploded[1]) == "tinyint" || trim($exploded[1]) == "longtext") {
				$type = $exploded[1];
				$contraits = 0;
				$status = count($exploded);

				if ($status > 2) {
					if ($exploded[2] == "" || empty($exploded[2])) {
						return "error on line is empty" . $exploded[1];
					}

					if (trim($exploded[1]) == "varchar" || trim($exploded[1]) == "char" || trim($exploded[1]) == "int") {
						if (!is_numeric(trim($exploded[2]))) {
							return "error on " . $exploded[0] . " : must be contraits number of " . $exploded[1];
						}
						$contraits = (int) trim($exploded[2]);
					}
				}
			} else {
				return "error on type data " . $exploded[0] . " error";
			}

			$temp = [
				"name" => $name,
				"type" => $type,
				"contraits" => $contraits,
				"null" => (strpos($obj, 'null') != false ?  'true' : 'false'),
				"default" => (strpos($obj, 'default') != false ?  $this->getStringBetween($obj, '(', ')') : 'false'),
				//NOTE enum choice use / and default will direct value so check it first 
				"enum" => (strpos($obj, 'enum') != false ?  $this->getStringBetween($obj, '[', ']') : 'false'),
				//NOTE Foreign key access with dots, so make it like student.id it will be produce table:student,column:id
				"foreign" => (strpos($obj, 'foreign') != false ? $this->getStringBetween($obj, '{', '}') : 'false'),
				"comment" => (strpos($obj, 'comment') != false ? $this->getStringBetween($obj, '`', '`') : 'false'),
				"primmary_key" => (strpos($obj, 'primmary_key') != false ?  'true' : 'false'),
				"auto_increment" => (strpos($obj, 'auto_increment') != false ?  'true' : 'false'),
				"unsigned" => (strpos($obj, 'unsigned') != false ?  'true' : 'false'),
				"unique" => (strpos($obj, 'unique') != false ?  'true' : 'false'),
			];

			array_push($result, $temp);
		}

		return $result;
	}




	//Helper
	function getStringBetween($str, $from, $to)
	{
		$sub = substr($str, strpos($str, $from) + strlen($from), strlen($str));
		return substr($sub, 0, strpos($sub, $to));
	}

	function paranoid($array)
	{
		$status_delete = [
			"name" => 'status_delete',
			"type" => 'int',
			"contraits" => 1,
			"null"			=> "true",
			"default" =>			"false",
			//NOTE enum choice use / and default will direct value so check it first 
			"enum" =>			"false",
			//NOTE Foreign key access with dots, so make it like student.id it will be produce table:student,column:id
			"foreign"			=> "false",
			"comment"			=> "false",
			"primmary_key"			=> "false",
			"auto_increment" => "false",
			"unique" => "false",
		];
		$entry_date = [
			"name" => 'entry_date',
			"type" => 'datetime',
			"contraits" => 0,
			"null"			=> "false",
			"default" => "CURRENT_TIMESTAMP",
			//NOTE enum choice use / and default will direct value so check it first 
			"enum" =>			"false",
			//NOTE Foreign key access with dots, so make it like student.id it will be produce table:student,column:id
			"foreign"			=> "false",
			"comment"			=> "false",
			"primmary_key"			=> "false",
			"auto_increment" => "false",	"unique" => "false",
		];
		$update_date = [
			"name" => 'update_date',
			"type" => 'datetime',
			"contraits" => 0,
			"null"			=> "false",
			"default" => "CURRENT_TIMESTAMP",
			//NOTE enum choice use / and default will direct value so check it first 
			"enum" =>			"false",
			//NOTE Foreign key access with dots, so make it like student.id it will be produce table:student,column:id
			"foreign"			=> "false",
			"comment"			=> "false",
			"primmary_key"			=> "false",
			"auto_increment" => "false",	"unique" => "false",
		];
		$delete_date = [
			"name" => 'delete_date',
			"type" => 'datetime',
			"contraits" => 0,
			"null"			=> "true",
			"default" => "false",
			//NOTE enum choice use / and default will direct value so check it first 
			"enum" =>			"false",
			//NOTE Foreign key access with dots, so make it like student.id it will be produce table:student,column:id
			"foreign"			=> "false",
			"comment"			=> "false",
			"primmary_key"			=> "false",
			"auto_increment" => "false",	"unique" => "false",
		];

		$entry_user = [
			"name" => 'entry_user',
			"type" => 'varchar',
			"contraits" => 200,
			"null"			=> "false",
			"default" => "false",
			//NOTE enum choice use / and default will direct value so check it first 
			"enum" =>			"false",
			//NOTE Foreign key access with dots, so make it like student.id it will be produce table:student,column:id
			"foreign"			=> "false",
			"comment"			=> "false",
			"primmary_key"			=> "false",
			"auto_increment" => "false",	"unique" => "false",
		];
		$update_user = [
			"name" => 'update_user',
			"type" => 'varchar',
			"contraits" => 200,
			"null"			=> "false",
			"default" => "false",
			//NOTE enum choice use / and default will direct value so check it first 
			"enum" =>			"false",
			//NOTE Foreign key access with dots, so make it like student.id it will be produce table:student,column:id
			"foreign"			=> "false",
			"comment"			=> "false",
			"primmary_key"			=> "false",
			"auto_increment" => "false",	"unique" => "false",
		];
		$delete_user = [
			"name" => 'delete_user',
			"type" => 'varchar',
			"contraits" => 200,
			"null"			=> "true",
			"default" => "false",
			//NOTE enum choice use / and default will direct value so check it first 
			"enum" =>			"false",
			//NOTE Foreign key access with dots, so make it like student.id it will be produce table:student,column:id
			"foreign"			=> "false",
			"comment"			=> "false",
			"primmary_key"			=> "false",
			"auto_increment" => "false",	"unique" => "false",
		];
		array_push($array, $status_delete);
		array_push($array, $entry_date);
		array_push($array, $update_date);
		array_push($array, $delete_date);
		array_push($array, $entry_user);
		array_push($array, $update_user);
		array_push($array, $delete_user);
		return $array;
	}
}
