<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Lang as ModelsLang;

class Lang extends BaseController
{
	public function __construct()
	{
		$this->lang = new ModelsLang();
	}
	public function index()
	{
		$data['lang'] = $this->lang->getall();
		return view('lang/content', $data);
	}
	public function add_lang()
	{
		return view("lang/content_add",);
	}
	public function createlang()
	{

		$name_lang = $this->request->getVar("name_lang");

		$data = [
			"name_lang" => $name_lang,
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

		$save = $this->lang->table()->delete(["id_lang" => $id]);
		if ($save) {
			echo "Berhasil Delete";
		} else {
			echo "Gagal Delete";
		}
	}
}
