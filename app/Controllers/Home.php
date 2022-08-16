<?php

namespace App\Controllers;

use App\Models\All;
use App\Models\Css;
use App\Models\Lang;

class Home extends BaseController
{
	public function __construct()
	{
		$this->css = new Css();
		$this->fw = new Lang();
		$this->all = new All();
		helper(['Helper_response']);
	}

	public function index()
	{
		$data['css'] = $this->css->getall();
		$data['fw'] = $this->fw->getall();
		return view('dashboard', $data);
	}

	public function sample_distinct()
	{

		$data = [
			[
				'id' => 1,
				'nama' => 'burhan',
			],
			[
				'id' => 2,
				'nama' => 'burhan',
			],
			[
				'id' => 2,
				'nama' => 'adit',
			],
			[
				'id' => 3,
				'nama' => 'jarwo',
			],
		];
		$data = distincData($data, 'nama');

		echo '<pre>;';
		print_r($data);
		echo '</pre>;';
		die();
	}
}
