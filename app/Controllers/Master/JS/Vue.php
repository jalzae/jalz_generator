<?php

namespace App\Controllers\Master\JS;

use App\Controllers\BaseController;
use App\Models\Console;

class Vue extends BaseController
{
	public function __construct()
	{
		$this->cmd = new Console();
	}
	public function addform()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('vue/add', $data);
	}

	public function editform()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('vue/edit', $data);
	}
}
