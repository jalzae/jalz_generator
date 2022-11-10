<?php

namespace App\Controllers;

use App\Models\All;
use App\Models\Css;
use App\Models\Lang;
use CodeIgniter\API\ResponseTrait;
use PhpParser\Node\Stmt\TryCatch;

class Home extends BaseController
{
	use ResponseTrait;
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

	public function save_menu()
	{
		$data['css'] = $this->all->table('css')->get()->getResult();
		$data['faq'] = $this->all->table('faq')->get()->getResult();
		$data['framework'] = $this->all->table('framework')->get()->getResult();
		$data['function'] = $this->all->table('function')->get()->getResult();
		$data['function_form'] = $this->all->table('function_form')->get()->getResult();
		$data['lang'] = $this->all->table('lang')->get()->getResult();
		$data['method'] = $this->all->table('method')->get()->getResult();

		$direktori = ROOTPATH . '/assets/file/';

		$string = file_put_contents($direktori . 'data.json', json_encode($data,true));
		if ($data) {
			return $this->respond("Sukses", 200);
		} else {
			return $this->respond("Failed", 400);
		}
	}

	public function load_menu()
	{
		$direktori = ROOTPATH . '/assets/file/';
		$string = file_get_contents($direktori . 'data.json');
		$data = json_decode($string, true);

		try {
			//code...
			$this->all->table('css')->insertBatch($data['css']);
			$this->all->table('faq')->insertBatch($data['faq']);
			$this->all->table('framework')->insertBatch($data['framework']);
			$this->all->table('function')->insertBatch($data['function']);
			$this->all->table('function_form')->insertBatch($data['function_form']);
			$this->all->table('lang')->insertBatch($data['lang']);
			$this->all->table('method')->insertBatch($data['method']);
			return $this->respond("Sukses", 200);
		} catch (\Throwable $th) {
			return $this->respond($th, 400);
		}
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
