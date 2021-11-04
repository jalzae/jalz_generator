<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Css as ModelsCss;

class Css extends BaseController
{
	public function __construct()
	{
		$this->lang = new ModelsCss();
	}
	public function index()
	{
		$data['lang'] = $this->lang->getall();
		return view('css/content', $data);
	}
	public function add_lang()
	{
		return view("css/content_add",);
	}
	public function createlang()
	{

		$name_framework = $this->request->getVar("name_framework");

		$data = [
			"name_css" => $name_framework,
		];

		$save = $this->lang->table()->insert($data);
		if ($save) {
			echo "Berhasil Insert";
		} else {
			echo "Gagal Insert";
		}
	}
	public function deletelang()
	{
		$id = $this->request->getVar("id");

		$save = $this->lang->table()->delete(["id_css" => $id]);
		if ($save) {
			echo "Berhasil Delete";
		} else {
			echo "Gagal Delete";
		}
	}
}
