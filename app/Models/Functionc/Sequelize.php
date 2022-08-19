<?php

namespace App\Models\Functionc;

use CodeIgniter\Model;

class Sequelize extends Model
{
	function resultSequelizeMigration($array, $tableName, $option = [])
	{
		echo "{";
		foreach ($array as $obj) {
			echo "
				";
			echo $obj['name'] . ': {
				';

			//Define type
			if ($obj['type'] == "uuid") {
				echo "type : Sequelize.UUID,
				";
			} else if ($obj['type'] == "string") {
				echo "type : Sequelize.STRING,
				";
			} else if ($obj['type'] == "varchar") {
				echo "type : Sequelize.STRING(" . $obj['contraits'] . "),
				";
			} else if ($obj['type'] == "int") {
				echo "type : Sequelize.INTEGER,
				";
			} else if ($obj['type'] == "bool") {
				echo "type : Sequelize.BOOLEAN,
				";
			} else if ($obj['type'] == "enum") {
				echo "type : Sequelize.ENUM(" . str_replace('/', ',', $obj['enum']) . "),
				";
			}

			//Define Default Value or not 
			if ($obj['default'] != "false") {
				echo "defaultValue:" . $obj['default'] . ",
				";
			}

			//Define Null or not 
			if ($obj['null'] == "true") {
				echo "allowNull:true,
				";
			}

			//Define primary key 
			if ($obj['primmary_key'] == "true") {
				echo "primaryKey:true,
				";
			}
			if ($obj['unique'] == "true") {
				echo "unique:true,
				";
			}

			//Define auto_increment
			if ($obj['auto_increment'] == "true") {
				echo "autoIncrement:true,
				";
			}
			echo "},
			";
		}
		echo "},";
	}

	function resultSequelizeModel($array, $tableName, $paranoid)
	{
		echo "{";
		foreach ($array as $obj) {
			echo "
				";
			echo $obj['name'] . ': {
				';

			//Define type
			if ($obj['type'] == "uuid") {
				echo "type : DataTypes.UUID,
				";
			} else if ($obj['type'] == "string") {
				echo "type : DataTypes.STRING,
				";
			} else if ($obj['type'] == "varchar") {
				echo "type : DataTypes.STRING(" . $obj['contraits'] . "),
				";
			} else if ($obj['type'] == "int") {
				echo "type : DataTypes.INTEGER,
				";
			} else if ($obj['type'] == "bool") {
				echo "type : DataTypes.BOOLEAN,
				";
			} else if ($obj['type'] == "enum") {
				echo "type : DataTypes.ENUM(" . str_replace('/', ',', $obj['enum']) . "),
				";
			}

			//Define Default Value or not 
			if ($obj['default'] != "false") {
				echo "defaultValue:" . $obj['default'] . ",
				";
			}

			//Define Null or not 
			if ($obj['null'] == "true") {
				echo "allowNull:true,
				";
			}

			//Define primary key 
			if ($obj['primmary_key'] == "true") {
				echo "primaryKey:true,
				";
			}
			if ($obj['unique'] == "true") {
				echo "unique:true,
				";
			}

			//Define auto_increment
			if ($obj['auto_increment'] == "true") {
				echo "autoIncrement:true,
				";
			}
			echo "},
			";
		}
		echo "},";
		echo "{";
		echo " paranoid:";
		if ($paranoid) {
			echo 'true,';
		} else {
			echo 'false,';
		}
		echo "tableName: '$tableName',
            timestamps: true,
            underscored: true,";
		echo "}";
	}
}
