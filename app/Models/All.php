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

	function include($data, $join, $orwhere = [], $type = 'array')
	{
		$dataarray = [];
		foreach ($data as $obj) {
			for ($i = 0; $i < count($join); $i++) {
				$builder = $this->db->table($join[$i]['model']);

				$where = [];

				for ($j = 0; $j < count($join[$i]['on']); $j++) {
					$where[$join[$i]['on'][$j]] = $obj[$join[$i]['on'][$j]];
				}

				if (count($join[$i]['join']) != 0) {
					for ($j = 0; $j < count($join[$i]['join']); $j++) {
						$builder->join($join[$i]['join'][$j]['table'], $join[$i]['join'][$j]['on'], $join[$i][$j]['type']);
					}
				}

				$builder->where($where);
				$builder->where($orwhere);

				$obj[$join[$i]['model']] = $builder->get()->getResult($type);
			}
			array_push($dataarray, $obj);
		}
		return $dataarray;
	}

	function paging_all(string $table = '', int $page = 1, int $per_page = 10, array $where = [])
	{
		$builder = $this->db->table($table);

		if (count($where) > 0) {
			$builder->where($where);
		}

		if ($page == 1) {
			$start = 0;
		} else {
			$start = ($page - 1) * $per_page;
		}
		$total = $builder->countAllResults(false);
		$array = $builder->get($per_page, $start)->getResult('array');

		$data = [
			'per_page' => (int) $per_page,
			'page' => (int) $page,
			'total_data' => (int) $total,
			'total_page' => (int) ceil($total / $per_page),
			'data' => $array,
		];
		return $data;
	}

	function paging($table, $array, $page, $per_page)
	{
		$total = $this->db->table($table)->countAllResults(false);
		$data = [
			'per_page' => $per_page,
			'page' => $page,
			'total_data' => $total,
			'total_page' => ceil($total / $per_page),
			'data' => $array,
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

	function includes($array, $include)
	{
		$array = json_decode(json_encode($array), true);
		// $table,$where
		// example $include=[['table','join on ','one/many']]
		$datas = [];

		$results = [];
		//separate include join on 
		foreach ($include as $obj) {
			$params = [];
			$key = explode("=", $obj['on']);
			$keys = $key[0];
			$filter = $key[1];
			foreach ($array as $obj1) {
				array_push($params, $obj1[$keys]);
			}

			//where in by filterkey
			$builder = $this->db->table($obj['table'])->whereIn($filter, $params);

			if (count($obj['join']) > 0) {
				foreach ($obj['join'] as $obj2) {
					$builder->join($obj2['table'], $obj2['on'], $obj['type']);
				}
			}

			$results[$obj['table']] = $builder->get()->getResult('array');
		}


		//foreach array 
		foreach ($array as $obj) {
			foreach ($include as $obj1) {
				$key = explode("=", $obj1['on']);
				$keys = $key[0];
				$filter = $key[1];
				$obj[$obj1['table']] = $this->filtering($results[$obj1['table']], $filter, $obj[$keys]);

				$structured = [];
				foreach ($obj[$obj1['table']] as $obj2) {
					array_push($structured, $obj2);
				}

				if ($obj1['type'] == 'one') {
					if (count($structured) > 0) {
						$obj[$obj1['table']]	= $structured[0];
					} else {
						$obj[$obj1['table']]	= null;
					}
				} else {
					$obj[$obj1['table']] = $structured;
				}
			}
			array_push($datas, $obj);
		}

		return $datas;
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

	function entryAt($data, $user = '')
	{
		$today = date('Y-m-d H:i:s');
		$data['entry_date'] = $today;
		if ($user != '') {
			$data['entry_user'] = $user;
		}

		return $data;
	}

	function updateAt($data, $user = '')
	{
		$today = date('Y-m-d H:i:s');
		$data['update_date'] = $today;
		if ($user != '') {
			$data['entry_user'] = $user;
		}

		return $data;
	}

	function restructureArr($arr)
	{
		$data = [];
		$keys = array_keys($arr);
		foreach ($keys as $obj) {
			array_push($data, $arr[$keys]);
		}
		return $data;
	}

	function filtering($arr, $string, $key)
	{
		$result = array_filter($arr, function ($var) use ($string, $key) {
			return ($var[$string] == $key);
		});

		return $result;
	}

	function runQuery($query)
	{
		$this->db->query($query);
	}

	function uploadImage($image, $ext, $path = 'assets/image/')
	{
		helper(['form', 'url', 'filesystem']);
		$ext = '.' . $ext;
		$random = date('YmdHis');

		$alamat = ROOTPATH . $path;
		$fulldirect = $path . $random . $ext;
		directory_map($alamat, FALSE, TRUE);
		$image->move($alamat,  $random . $ext);

		return $fulldirect;
	}

	function timestamp($data)
	{
		$today = date('Y-m-d H:i:s');
		$data['entry_date'] = $today;
		$data['update_date'] = $today;

		return $data;
	}
}
