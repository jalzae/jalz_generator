<?php

namespace App\Controllers\Master\JS;

use App\Controllers\BaseController;
use App\Models\Console;

class Typerscript extends BaseController
{
	public function __construct()
	{
		$this->cmd = new Console();
	}
	public function constructor()
	{
		//
	}

	public function vuex()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);
		$data['limit'] = count($data['column']);

		return view('typescript/nuxtjs/vuex', $data);
	}
}
