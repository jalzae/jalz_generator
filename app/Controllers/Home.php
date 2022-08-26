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

	public function sample_include()
	{

		$data = $this->all->join('data_kelas');
		$data['data'] = $this->all->include($data['data'], [
			[
				'model' => 'data_siswa',
				'on' => [
					'id_kelas'
				]
			]
		]);
	}
}
