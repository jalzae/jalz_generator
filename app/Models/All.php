<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use Throwable;

class All extends Model
{
	function table($table)
	{
		return $this->db->table($table);
	}

	function getall($table)
	{
		return $this->db->table($table)->get()->getResult();
	}

	function getbyorder($table, $column, $opsi)
	{
		return $this->db->table($table)->orderBy($column, $opsi)->get()->getResult();
	}

	function getrow($table, $data)
	{
		return $this->db->table($table)->where($data)->get(1)->getRowArray();
	}

	function put($table, $data)
	{

		try {
			$this->db->table($table)->insert($data);
			$data = $this->table($table)->where($data)->get(1)->getRowArray();
			return $data;
		} catch (Exception $e) {
			return false;
		}
	}

	function putAll($table, $data)
	{
		return $this->db->table($table)->insertBatch($data);
	}

	function patch($table, $data, $param, $id)
	{
		try {
			$this->db->table($table)->update($data, [$param => $id]);
			$data = $this->table($table)->where([$param => $id])->get(1)->getRowArray();
			return $data;
		} catch (Exception $e) {
			return false;
		}
	}

	function patchAll($table, $data, $condition)
	{
		return $this->db->table($table)->update($data, $condition);
	}

	function remove($table, $param, $id)
	{
		return $this->db->table($table)->delete([$param => $id]);
	}

	function removeAll($table, $id)
	{
		return $this->db->table($table)->delete($id);
	}

	function get($table, $data)
	{
		return $this->db->table($table)->where($data);
	}

	function getdata($table, $data)
	{
		return $this->db->table($table)->where($data)->get()->getResult();
	}

	function getdatabyorder($table, $data, $column, $asc)
	{
		return $this->db->table($table)->where($data)->orderBy($column, $asc)->get()->getResult();
	}
	function getjoin($table, $table2, $cond, $data)
	{
		return $this->db->table($table)->join($table2, $cond)->where($data);
	}

	function getjoin2($table, $table2, $cond, $table3, $cond3, $data)
	{
		return $this->db->table($table)->join($table2, $cond)->join($table3, $cond3)->where($data);
	}

	function join($table, $select = '*', $join = [], $where = [], $orderby = [], $page = 1, $per_page = 10, $type = 'array')
	{

		if ($page == 1) {
			$start = 0;
		} else {
			$start = ($page - 1) * $per_page;
		}

		$dataarray = [];

		$builder = $this->db->table($table);
		$builder->select($select);
		$builder->where($where);

		if (count($join) != 0) {
			for ($i = 0; $i < count($join); $i++) {
				$builder->join($join[$i]['model'], $join[$i]['on'], $join[$i]['type']);
			}
		}

		if (count($orderby) != 0) {
			$orderbys = '';
			for ($i = 0; $i < count($orderby); $i++) {
				$orderbys .= $orderby[$i] . ',';
			}
			$orderbys = substr($orderbys, 0, -1);
			$builder->orderBy($orderbys);
		}

		$dataarray =	$builder->get($per_page, $start)->getResult($type);

		$jumlah = $builder->countAllResults(false);

		$data = [
			'per_page' => $per_page,
			'total_data' => $jumlah,
			'total_page' => ceil($jumlah / $per_page),
			'page' => $page,
			'data' => $dataarray,
		];
		return $data;
	}

	/**
	 * Distinct Data
	 *
	 * @param array|object  $data    data must be object or array
	 * @param array|object  $join    join must be object or array
	 * @param string  $type    String must be string
	 */

	function include($data, $join, $type = 'array')
	{
		$dataarray = [];
		foreach ($data as $obj) {
			for ($i = 0; $i < count($join); $i++) {

				$where = [];
				for ($j = 0; $j < count($join[$i]['on']); $j++) {
					$where[$join[$i]['on'][$j]] = $obj[$join[$i]['on'][$j]];
				}
			
				$obj[$join[$i]['model']] = $this->table($join[$i]['model'])->where($where)->get()->getResult($type);
			}
			array_push($dataarray, $obj);
		}

		return $dataarray;
	}

	function paging_all($array, $per_page)
	{
		$dataarray = array_chunk($array,  $per_page);
		$data = [
			'per_page' => $per_page,
			'total_data' => count($array),
			'total_page' => ceil(count($array) / $per_page),
			'data' => $dataarray,
		];
		return $data;
	}

	function paging($array, $start, $per_page)
	{
		$dataarray = array_slice($array, $start, $per_page);
		$data = [
			'per_page' => $per_page,
			'total_data' => count($array),
			'total_page' => ceil(count($array) / $per_page),
			'data' => $dataarray,
		];
		return $data;
	}

	function pagination($table, $where = [], $orderby = [], $include = [], $aliases = true, $page = 1, $per_page = 10, $like = [], $orLike = [], $groupBy = [],  $distinct = '', $select = ['*'], $customSelect = '', $result = 'array')
	{
		if ($page == 1) {
			$start = 0;
		} else {
			$start = ($page - 1) * $per_page;
		}

		$dataarray = [];
		$builder = $this->db->table($table);
		$builder->where($where);

		if (count($select) > 1) {
			$column = "";
			for ($i = 0; $i < count($select); $i++) {
				$column .= $select[$i] . ',';
			}
			$column = substr($column, 0, -1);
			$builder->select($column);
		} else 	if (count($include) != 0 && $aliases == true) {
			$string = "";
			$string .= $this->table_column($table);
			for ($i = 0; $i < count($include); $i++) {
				$tablename = $include[$i]['model'];
				$string .= $this->table_column($tablename);
			}
			$builder->select(substr($string, 0, -1));
		} else {
			$builder->select('*');
		}

		if ($customSelect == 'max') {
			$builder->selectMax($select[0]);
		} else  if ($customSelect == 'min') {
			$builder->selectMin($select[0]);
		} else  if ($customSelect == 'avg') {
			$builder->selectAvg($select[0]);
		} else   if ($customSelect == 'sum') {
			$builder->selectSum($select[0]);
		}

		if (count($orderby) != 0) {
			$builder->orderBy($orderby[0], $orderby[1]);
		}
		if ($distinct != '') {
			$builder->distinct($distinct);
		}

		if (count($like) != 0) {
			for ($i = 0; $i < count($like); $i++) {
				$builder->like($like[$i]['column'], $like[$i]['value'], $like[$i]['wildcard']);
			}
		}

		if (count($orLike) != 0) {
			for ($i = 0; $i < count($orLike); $i++) {
				$builder->orLike($orLike[$i]['column'], $orLike[$i]['value'], $orLike[$i]['wildcard']);
			}
		}

		if (count($groupBy) != 0) {
			$builder->groupBy($groupBy);
		}

		if (count($include) != 0) {
			for ($i = 0; $i < count($include); $i++) {
				$builder->join($include[$i]['model'], $include[$i]['on'], $include[$i]['type']);
			}
		}

		$dataarray = $builder->get($per_page, $start)->getResult($result);

		if (count($include) != 0 && $aliases == true) {
			// $dataarray = $this->includes($dataarray, $include);
			//TODO nanti
		}


		$jumlah = $builder->countAllResults(false);

		$data = [
			'per_page' => $per_page,
			'total_data' => $jumlah,
			'total_page' => ceil($jumlah / $per_page),
			'page' => $page,
			'data' => $dataarray,
		];
		return $data;
	}

	function validator($rule, $error)
	{
		return  ['rule' => $rule, 'error' => $error];
	}

	function succes($data)
	{
		return  [
			"status" => 200,
			"message" => 'Sukses',
			"data" => $data,
		];
	}

	function success($data, $message)
	{
		return  [
			"status" => 200,
			"message" => $message,
			"data" => $data,
		];
	}

	function fail()
	{
		return  [
			"status" => 400,
			"message" => "Gagal",
			"data" => [],
		];
	}

	function failure($message)
	{
		return  [
			"status" => 400,
			"message" => $message,
			"data" => [],
		];
	}

	function addIndex($table, $column = [])
	{
		try {
			foreach ($column as $obj) {
				$this->commandIndex($obj['name'], $table, $obj['column'], $obj['length']);
			}

			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	function commandIndex($name, $table, $column, $length = 1)
	{
		$query = "CREATE INDEX $name USING BTREE ON $table ($column ($length));";
		$this->db->query($query);
	}

	function generateUUID($table)
	{
		$jumlah = $this->table($table)->countAllResults(false);
		$fields = $this->db->getFieldData($table);
		$UUID = $this->generate($jumlah);

		while ($this->table($table)->where([$fields[0]->name => $UUID])->countAllResults(false) == 1) {
			$UUID = $this->generate($jumlah);
		}

		return $UUID;
	}

	function generate($jumlah)
	{
		$UUID = uniqid($jumlah, true);
		$UUID = str_replace(".", "", $UUID);
		$UUID = substr($UUID, 0, 8) . '-' . substr($UUID, 8, 4) . '-' . substr($UUID, 12, 4) . '-' . substr($UUID, 16, 4)  . '-' . substr($UUID, 20);
	}

	function search_index($data)
	{
		$json = json_decode(file_get_contents(ROOTPATH . 'assets/data/search.json'), true);
		$lastindex = count($json);
		$json[$lastindex] = ['value' => $data];
		file_put_contents(ROOTPATH . 'assets/data/search.json', json_encode($json));
	}

	function migrate()
	{
		$migrate = \Config\Services::migrations();
		try {
			$migrate->latest();
			return true;
		} catch (Throwable $e) {
			return false;
		}
	}

	function seeding()
	{

		$files = glob(APPPATH . 'Database/Seeds/*');

		try {
			$seeder = \Config\Database::seeder();

			foreach ($files as $file) {
				$seeder->call(basename($file, ".php"));
			}

			return $this->respond(['message' => 'Sukses Seeding'], 200);
		} catch (Exception $e) {
			return $this->respond(['message' => 'Gagal Seeding'], 201);
		}
	}

	function table_column($table)
	{
		$fields = $this->db->getFieldNames($table);
		$columns = "";
		foreach ($fields as $field) {
			$columns .=  "$table." . $field . " as " . ucfirst(str_replace("_", "", $table)) . ucfirst(str_replace("_", "", $field)) . ",";
		}
		return $columns;
	}

	function includes($result, $include)
	{

		//Hasilnya diloop
		$result = json_decode(json_encode($result), true);

		$filtering = $this->distinctIt($result);

		//includes dan push ke id sebagai batch array 
		//TODO foreach filtering kemudian cari value dari kolom keys yang sama
		foreach ($filtering as $index => $value) {
			$colors = array_column($result, 'fav_color');
			$found_key = array_search('blue', $colors);
		}

		return $filtering;
	}

	function distinctIt($filtered)
	{

		$result = array_filter(
			$filtered,
			function ($value, $index) use ($filtered) {
				$keys = array_key_first($value);
				return $index === array_search($value[$keys], array_column($filtered, $keys));
			},
			ARRAY_FILTER_USE_BOTH
		);

		return $result;
	}
}
