<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Test extends BaseController
{
	use ResponseTrait;
	public function __construct()
	{
	}

	public function loadjson()
	{
		helper(['form', 'url', 'filesystem']);
		$file = $this->request->getFile('fileupload');
		$direktori = ROOTPATH . '/assets/file/';
		$file->move($direktori, 'example.json');

		$string = file_get_contents($direktori . 'example.json');
		$json = json_decode($string, true);

		unlink($direktori . 'example.json');

		return $this->respond($json, 200);
	}

}
