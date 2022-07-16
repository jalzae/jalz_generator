<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Functionc\Ci4;
use App\Models\Functionc\Sequelize;

class Command extends BaseController
{
	public function __construct()
	{

		$this->sequelize = new Sequelize();
		$this->ci4 = new Ci4();
	}
	public function generate()
	{
		$json = $this->request->getVar('json');
		$cmd = $this->request->getVar('cmd');
		$data = explode(",", $json);
		$command = explode(" ", $cmd);

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
				return $this->sequelize->resultSequelizeMigration($checked, $command[2]);
			}

			//Sequelize Model
			else if ($command[1] == "model") {
				if (empty($command[2])) {
					return "Name Model result must be provided";
				}
				return $this->sequelize->resultSequelizeModel($checked, $command[2]);
			}

			//Sequelize Validation
			else if ($command[1] == "validation") {
				if (empty($command[2])) {
					return "Name Model result must be provided";
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
			return "access methods on ci4 is not configured";
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

					if (trim($exploded[1]) == "varchar" || trim($exploded[1]) == "char") {
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
				"enum" => (strpos($obj, 'default') != false ?  $this->getStringBetween($obj, '[', ']') : 'false'),
				"primmary_key" => (strpos($obj, 'primmary_key') != false ?  'true' : 'false'),
				"auto_increment" => (strpos($obj, 'auto_increment') != false ?  'true' : 'false'),
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
}
