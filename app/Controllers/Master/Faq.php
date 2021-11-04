<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Faq as ModelsFaq;

class Faq extends BaseController
{

	public function __construct()
	{
		$this->faq = new ModelsFaq();
	}
	public function createfaq()
	{

		$version_name = $this->request->getVar("version_name");
		$desc_update = $this->request->getVar("desc_update");
		$entry_user = 'Admin';
		$entry_date = date("Y-m-d H:i:s", strtotime("+12 hours"));

		$data = [
			"version_name" => $version_name,
			"desc_update" => $desc_update,
			"entry_user" => $entry_user,
			"entry_date" => $entry_date,
		];

		$save = $this->faq->table()->insert($data);
		if ($save) {
			echo "Berhasil Insert";
		} else {
			echo "Gagal Insert";
		}
	}
	public function getfaq()
	{

		$data['faqs'] = $this->faq->table()->orderBy('entry_date','DESC')->get()->getResult();
		return view("faqs/content", $data);
	}

	public function deletefaq()
	{
		$id = $this->request->getVar("id");

		$save = $this->faq->table()->delete(["id_faq" => $id]);
		if ($save) {
			echo "Berhasil Delete";
		} else {
			echo "Gagal Delete";
		}
	}
	
}
