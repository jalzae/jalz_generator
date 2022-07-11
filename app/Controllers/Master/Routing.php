<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Css;
use App\Models\Framework;
use App\Models\Functionformtable;
use App\Models\Functiontable;
use App\Models\Methodtable;

class Routing extends BaseController
{
	public function __construct()
	{
		$this->fw = new Framework();
		$this->methods = new Methodtable();
		$this->route = new Functiontable();
		$this->routecss = new Functionformtable();
		$this->css = new Css();
	}
	public function index()
	{
		$data['lang'] = $this->route->table()->join('framework', 'function.id_framework=framework.id_framework')->join('method', 'method.id_method=function.id_method')->get()->getResult();

		$data['css'] = $this->routecss->table()->join('css', 'function_form.id_css=css.id_css')->join('method', 'method.id_method=function_form.id_method')->get()->getResult();

		return view('routing/content', $data);
	}
	public function add_lang()
	{
		$data['fw'] = $this->fw->getall();
		$data['method'] = $this->methods->getall();
		return view("routing/content_add", $data);
	}
	public function add_css()
	{
		$data['css'] = $this->css->getall();
		$data['method'] = $this->methods->getall();
		return view("routing/content_add_css", $data);
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
	public function createcss()
	{
		$id_framework = $this->request->getVar("id_framework");
		$id_method = $this->request->getVar("id_method");
		$route = $this->request->getVar("route");

		$data = [
			"id_css" => $id_framework,
			"id_method" => $id_method,
			"route" => $route,
		];

		$save = $this->routecss->table()->insert($data);
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
	public function deletecss()
	{
		$id = $this->request->getVar("id");

		$save = $this->routecss->table()->delete(["id_function " => $id]);
		if ($save) {
			echo "Berhasil Delete";
		} else {
			echo "Gagal Delete";
		}
	}
}
