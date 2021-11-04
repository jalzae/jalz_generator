<?php

namespace App\Controllers\Master\PHP;

use App\Controllers\BaseController;
use App\Models\Console;

class Codeigniter4 extends BaseController
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
		return view('ci4/create', $data);
	}
	public function read()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4/read', $data);
	}
	public function update()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4/update', $data);
	}
	public function delete()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4/delete', $data);
	}
	public function detail()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4/detail', $data);
	}
	public function crud()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4/crud',$data);
	}
	public function validation()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4/create', $data);
	}
	public function route()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4/create', $data);
	}
	public function model()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci4/create', $data);
	}

	
}
