<?php

namespace App\Controllers;

use App\Models\Css;
use App\Models\Lang;

class Home extends BaseController
{
	public function __construct()
	{
		$this->css = new Css();
		$this->fw = new Lang();
	}
	public function index()
	{
		$data['css'] = $this->css->getall();
		$data['fw'] = $this->fw->getall();
		return view('dashboard', $data);
	}
}
