<?php

namespace App\Controllers\Master\Js;

use App\Controllers\BaseController;

class Sequelize extends BaseController
{
	public function model()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$namespace = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);
		$data['limit'] = $limit;
		$data['namespace'] = $namespace;
		return view('sequelize/model', $data);
	}

	public function crud()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$namespace = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);
		$data['limit'] = $limit;
		$data['namespace'] = $namespace;
		return view('sequelize/crud', $data);
	}

	public function route()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$namespace = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);
		$data['limit'] = $limit;
		$data['namespace'] = $namespace;
		return view('sequelize/route', $data);
	}

	public function index()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$namespace = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);
		$data['limit'] = $limit;
		$data['namespace'] = $namespace;
		return view('sequelize/index', $data);
	}

	public function validation()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$namespace = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);
		$data['limit'] = $limit;
		$data['namespace'] = $namespace;
		return view('sequelize/validation', $data);
	}
}
