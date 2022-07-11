<?php

namespace App\Controllers\Master\PHP;

use App\Controllers\BaseController;
use App\Models\Console;

class Codeigniter3 extends BaseController
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
		return view('ci3/create', $data);
	}
	public function read()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci3/read', $data);
	}
	public function update()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci3/update', $data);
	}
	public function delete()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci3/delete', $data);
	}
	public function detail()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci3/detail', $data);
	}
	public function crud()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci3/crud',$data);
	}
	
	public function model()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		return view('ci3/model', $data);
	}

	
}
