<?php

namespace App\Models;

use CodeIgniter\Model;

class Console extends Model
{
	public function show_db()
	{
		return $this->db->query('SHOW DATABASES;')->getResult();
	}
	public function show_table($db)
	{
		return $this->db->query('SHOW TABLES IN ' . $db . ';')->getResult('array');
	}
	public function show_column($db, $table)
	{
		return $this->db->query('SHOW COLUMNS FROM ' . $db . '.' . $table . '')->getResult('array');
	}
}
