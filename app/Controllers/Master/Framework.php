<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Framework as ModelsFramework;
use App\Models\Lang;

class Framework extends BaseController
{
	public function __construct()
	{
		$this->lang = new ModelsFramework();
		$this->bahasa = new Lang();
	}
	public function index()
	{
		$data['lang'] = $this->lang->table()->join('lang', 'lang.id_lang=framework.id_lang')->get()->getResult();
		return view('framework/content', $data);
	}
	public function add_lang()
	{
		$data['bahasa'] = $this->bahasa->getall();
		return view("framework/content_add", $data);
	}
	public function createlang()
	{

		$name_framework = $this->request->getVar("name_framework");
		$id_lang = $this->request->getVar("id_lang");

		$data = [
			"name_framework" => $name_framework,
			"id_lang" => $id_lang,
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

		$save = $this->lang->table()->delete(["id_framework" => $id]);
		if ($save) {
			echo "Berhasil Delete";
		} else {
			echo "Gagal Delete";
		}
	}
}
