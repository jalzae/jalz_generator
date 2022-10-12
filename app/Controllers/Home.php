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
		$data = $this->all->table('employe')->get(10)->getResult('array');
		$data = $this->all->includes($data, [
			[
				"table" => 'employe_staff',
				'on' => 'id_employe=id_employe',
				'type' => 'one',
				'join' => [
					[
						'table' => 'employe_staff_unit',
						'on' => 'employe_staff.id_staff=employe_staff_unit.id_employe_staff_unit',
						'type' => 'left'
					]
				]
			]
		]);

		echo '<pre>;';
		print_r($data);
		echo '</pre>;';
		die();
	}
}
