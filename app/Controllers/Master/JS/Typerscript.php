<?php

namespace App\Controllers\Master\JS;

use App\Controllers\BaseController;
use App\Models\Console;

class Typerscript extends BaseController
{
	public function __construct()
	{
		$this->cmd = new Console();
	}
	public function axios()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$name = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['url'] = $name;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);

		return view('typescript/nuxtjs/crud', $data);
	}

	public function vuex()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		$data['limit'] = count($data['column']);

		return view('typescript/nuxtjs/vuex', $data);
	}
}
