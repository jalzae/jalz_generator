<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use Throwable;

class All extends Model
{
	public function table($table)
	{
		return $this->db->table($table);
	}

	public function getall($table)
	{
		return $this->db->table($table)->get()->getResult();
	}

	public function getbyorder($table, $column, $opsi)
	{
		return $this->db->table($table)->orderBy($column, $opsi)->get()->getResult();
	}

	public function getrow($table, $data)
	{
		return $this->db->table($table)->where($data)->get(1)->getRowArray();
	}

	public function put($table, $data)
	{

		try {
			$this->db->table($table)->insert($data);
			$data = $this->table($table)->where($data)->get(1)->getRowArray();
			return $data;
		} catch (Exception $e) {
			return false;
		}
	}

	public function putAll($table, $data)
	{
		return $this->db->table($table)->insertBatch($data);
	}

	public function patch($table, $data, $param, $id)
	{
		try {
			$this->db->table($table)->update($data, [$param => $id]);
			$data = $this->table($table)->where([$param => $id])->get(1)->getRowArray();
			return $data;
		} catch (Exception $e) {
			return false;
		}
	}

	public function patchAll($table, $data, $condition)
	{
		return $this->db->table($table)->update($data, $condition);
	}

	public function remove($table, $param, $id)
	{
		return $this->db->table($table)->delete([$param => $id]);
	}

	public function removeAll($table, $id)
	{
		return $this->db->table($table)->delete($id);
	}

	public function get($table, $data)
	{
		return $this->db->table($table)->where($data);
	}

	public function getdata($table, $data)
	{
		return $this->db->table($table)->where($data)->get()->getResult();
	}

	public function getdatabyorder($table, $data, $column, $asc)
	{
		return $this->db->table($table)->where($data)->orderBy($column, $asc)->get()->getResult();
	}
	public function getjoin($table, $table2, $cond, $data)
	{
		return $this->db->table($table)->join($table2, $cond)->where($data);
	}

	public function getjoin2($table, $table2, $cond, $table3, $cond3, $data)
	{
		return $this->db->table($table)->join($table2, $cond)->join($table3, $cond3)->where($data);
	}

	public static function paging_all($array, $per_page)
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

	function pagination($table, $where = [], $orderby = [], $include = [], $page = 1, $per_page = 10, $like = [], $orLike = [], $groupBy = [], $distinct = '', $select = ['*'], $customSelect = '')
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
			for ($i = 1; $i < count($select); $i++) {
				$column .= $select[$i] . ',';
			}
			$column = substr($column, 0, -1);
			$builder->select($column);
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
			for ($i = 1; $i < count($like); $i++) {
				$builder->like($like[$i]['column'], $like[$i]['value'], $like[$i]['wildcard']);
			}
		}

		if (count($orLike) != 0) {
			for ($i = 1; $i < count($orLike); $i++) {
				$builder->orLike($orLike[$i]['column'], $orLike[$i]['value'], $orLike[$i]['wildcard']);
			}
		}

		if (count($groupBy) != 0) {
			$builder->groupBy($groupBy);
		}

		if (count($include) != 0) {
			for ($i = 1; $i < count($include); $i++) {
				$builder->join($include[$i]['model'], $include[$i]['on'], $include[$i]['type']);
			}
		}

		$dataarray = $builder->get($per_page, $start)->getResult();

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
}
