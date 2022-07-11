<?php

namespace App\Controllers\Master\JS;

use App\Controllers\BaseController;
use App\Models\Console;

class Axios extends BaseController
{
	public function __construct()
	{
		$this->cmd = new Console();
	}
	public function get()
	{
		echo "axios.get(baseUrl + url+'/'+id, {
			headers: headers
		}).then((response) => {
			console.log(response);
		}).catch((error) => {
			console.log(error);
		});";
	}
	public function post()
	{
		echo " axios.post( url, data, {
			headers: header
		}).then((response) => {
			console.log('response.data');
		})
		.catch((error) => {
			console.log(error);
		});";
	}

	public function delete()
	{
		echo " axios.delete( url, data, {
			headers: header
		}).then((response) => {
			console.log('response.data');
		})
		.catch((error) => {
			console.log(error);
		});";
	}

	public function crud()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$name = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['url'] = $name;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);

		return view('axios/crud', $data);
	}

	public function crudvue()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$name = $this->request->getVar('namespace');
		$data['table'] = $table;
		$data['url'] = $name;
		$data['column'] = $this->cmd->show_column($db, $table);
		$limit = count($data['column']);

		return view('axios/crudvue', $data);
	}
}
