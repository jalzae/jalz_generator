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
	}

	public function index()
	{
		$data['css'] = $this->css->getall();
		$data['fw'] = $this->fw->getall();
		return view('dashboard', $data);
	}

	public function test()
	{

		$data =	$this->all->pagination('data_kelas', [
			'data_kelas.id_kelas' => 1
		], [], [
			[
				'model' => 'data_siswa',
				'on' => 'data_kelas.id_kelas=data_siswa.id_kelas',
				'type' => 'inner'
			]
		]);

		echo '<pre>;';
		print_r($data);
		echo '</pre>;';
		die();
	}
}
