<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Console as ModelsConsole;
use App\Models\Framework;
use App\Models\Functiontable;
use App\Models\Methodtable;

class Console extends BaseController
{
	public function __construct()
	{
		$this->dbnya = new ModelsConsole();
		$this->methods = new Methodtable();
		$this->route = new Functiontable();
		$this->fw = new Framework();
	}
	public function generator()
	{
		$id = $this->request->getVar('id');
		$data['databes'] = $this->dbnya->show_db();
		$data['fw'] = $this->fw->getdata(['id_lang' => $id]);
		$data['methods'] = $this->methods->getall();
		return view('generator/content', $data);
	}
	public function show_table()
	{
		$id = $this->request->getVar('id');
		$data['tables'] = $this->dbnya->show_table($id);

		$i = 0;
		foreach ($data['tables'] as $obj) {
			echo '<option value="' . $obj["Tables_in_$id"] . '">';
			print_r($obj["Tables_in_$id"]);
			echo "</option>";
			$i++;
		}
	}
	public function show_column()
	{
		$id = $this->request->getVar('id');
		$db = $this->request->getVar('db');
		$data['tables'] = $this->dbnya->show_column($db, $id);
	}

	public function show_method()
	{
		$id = $this->request->getVar('id');
		$data['method'] = $this->route->table()->where(['id_framework' => $id])->join('method', 'method.id_method=function.id_method')->get()->getResult();

		if (count($data['method']) == 0) {
			echo "<option>No Methods here</option>";
			die();
		}

		foreach ($data['method'] as $obj) {
			echo '<option value="' . $obj->id_function . '">' . $obj->name_method . '</option>';
		}
	}

	public function execute()
	{
		$id = $this->request->getVar('id');
		$row = $this->route->getrow(['id_function' => $id]);

		return $row['route'];
	}
}
