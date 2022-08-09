<?php

namespace App\Controllers\Master\Golang;

use App\Controllers\BaseController;
use App\Models\Console;

class Gorm extends BaseController
{
	public function __construct()
	{
		$this->cmd = new Console();
	}
	public function models()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$column = $this->cmd->show_column($db, $table);

		echo 'package models
import (
	"gorm.io/gorm"
	"time"
)
';

		echo 'type ' . ucfirst($table) . ' struct {
    ';
		foreach ($column as $key => $obj) {
			echo ucfirst($obj['Field']) . ' ';

			if (strpos($obj['Type'], 'int') !== false) {
				echo "int ";
			} else if (strpos($obj['Type'], 'varchar') !== false) {
				echo "string ";
			} elseif (strpos($obj['Type'], 'text') !== false) {
				echo "string ";
			} else if (strpos($obj['Type'], 'datetime') !== false) {
				echo "time.Time ";
			}

			echo '`form:"' . $obj['Field'] . '" json:"' . $obj['Field'] . '" xml:"' . $obj['Field'] . '" ';

			if ($obj['Null'] == "NO" && $key != 0) {
				echo 'binding:"required" ';
			}

			echo 'gorm:"column:' . $obj['Field'] . ';';

			if ($key == 0) {
				echo "primary_key;auto_increment;";
			} else {
				echo "type:";
			}

			echo $obj['Type'] . ';';


			if ($obj['Null'] == "NO") {
				echo 'not null;';
			}
			echo '"`
    ';
		}
		echo 'table string `gorm:"-"`';

		echo '
}
';

		echo 'func (p ' . ucfirst($table) . ') TableName() string {
	if p.table != "" {
		return p.table
	}
	return "' . $table . '" 
}

';
		//model create
		echo 'func Create' . $table . '(db *gorm.DB, user *' . ucfirst($table) . ') (err error) {
	err = db.Create(user).Error
	if err != nil {
		return err
	}
	return nil
}

';

		///model getall
		echo '
func Get' . $table . 's(db *gorm.DB, user *[]' . ucfirst($table) . ') (err error) {
	err = db.Find(user).Error
	if err != nil {
		return err
	}
	return nil
}

';


		///model get detail 
		echo '
func Get' . $table . '(db *gorm.DB, user *' . ucfirst($table) . ', usersId string) (err error) {
	err = db.Where("' . $column[0]['Field'] . ' = ?", usersId).First(user).Error
	if err != nil {
		return err
	}
	return nil
}

';


		//update user
		echo 'func Update' . $table . '(db *gorm.DB, user *' . ucfirst($table) . ') (err error) {
	db.Save(user)
	return nil
}

';


		//delete user
		echo 'func Delete' . $table . '(db *gorm.DB, user *' . ucfirst($table) . ', usersId string) (err error) {
	db.Where("' . $column[0]['Field'] . ' = ?", usersId).Delete(user)
	return nil
}';
	}
}
