<?php

namespace App\Controllers\Master\PHP;

use App\Controllers\BaseController;
use App\Models\Console;

class Ci4api extends BaseController
{
	public function __construct()
	{
		$this->cmd = new Console();
	}
	public function create()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/create', $data);
	}
	public function read()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/read', $data);
	}
	public function update()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/update', $data);
	}
	public function delete()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/delete', $data);
	}
	public function detail()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/detail', $data);
	}
	public function crud()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/crud', $data);
	}
	public function validation()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/validation', $data);
	}
	public function route()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/route', $data);
	}
	public function model()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4api/model', $data);
	}
}
