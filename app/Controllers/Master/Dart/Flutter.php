<?php

namespace App\Controllers\Master\Dart;

use App\Controllers\BaseController;
use App\Models\Console;

class Flutter extends BaseController
{
	public function __construct()
	{
		$this->cmd = new Console();
	}
	public function controller()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$name = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['url'] = $name;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);
		$data['limit']=$limit;

		return view('flutter/crud', $data);
	}

	public function validator()
	{
		//
	}

	public function service()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$name = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['url'] = $name;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);
		$data['limit']=$limit;

		return view('flutter/service/crud', $data);
	}

	public function maprequest()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$name = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['url'] = $name;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);
		$data['limit']=$limit;

		return view('flutter/mapbodyreq', $data);
	}
}
