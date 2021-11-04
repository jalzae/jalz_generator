<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Framework;
use App\Models\Functiontable;
use App\Models\Methodtable;

class Routing extends BaseController
{
	public function __construct()
	{
		$this->fw = new Framework();
		$this->methods = new Methodtable();
		$this->route = new Functiontable();
	}
	public function index()
	{
		$data['lang'] = $this->route->table()->join('framework', 'function.id_framework=framework.id_framework')->join('method', 'method.id_method=function.id_method')->get()->getResult();
		return view('routing/content', $data);
	}
	public function add_lang()
	{
		$data['fw'] = $this->fw->getall();
		$data['method'] = $this->methods->getall();
		return view("routing/content_add", $data);
	}
	public function createlang()
	{

		$id_framework = $this->request->getVar("id_framework");
		$id_method = $this->request->getVar("id_method");
		$route = $this->request->getVar("route");

		$data = [
			"id_framework" => $id_framework,
			"id_method" => $id_method,
			"route" => $route,
		];

		$save = $this->route->table()->insert($data);
		if ($save) {
			echo "Berhasil Insert";
		} else {
			echo "Gagal Insert";
		}
	}
	public function deletelang()
	{
		$id = $this->request->getVar("id");

		$save = $this->route->table()->delete(["id_function " => $id]);
		if ($save) {
			echo "Berhasil Delete";
		} else {
			echo "Gagal Delete";
		}
	}
}
