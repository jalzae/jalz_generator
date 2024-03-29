<?php

namespace App\Models;

use CodeIgniter\Model;

class Framework extends Model
{

	protected $DBGroup              = "default";
	protected $table                = "framework";
	protected $primaryKey           = "id_framework";
	protected $useAutoIncrement     = true;
	protected $insertID             = 1;
	protected $returnType           = "object";
	protected $useSoftDeletes       = false;
	protected $protectFields        = false;
	protected $allowedFields        = ["*"];
	public function __construct()
	{
		$this->db = \Config\Database::connect('generator');
	}
	public function table()
	{
		return $this->db->table($this->table);
	}


	public function getall()
	{
		return $this->db->table($this->table)->get()->getResult();
	}

	public function getbyorder($column, $opsi)
	{
		return $this->db->table($this->table)->orderBy($column, $opsi)->get()->getResult();
	}

	public function getrow($data)
	{
		return $this->db->table($this->table)->where($data)->get(1)->getRowArray();
	}

	public function put($data)
	{
		return $this->db->table($this->table)->insert($data);
	}

	public function putAll($data)
	{
		return $this->db->table($this->table)->insertBatch($data);
	}

	public function patch($data, $id)
	{
		return $this->db->table($this->table)->update($data, ["id_framework" => $id]);
	}

	public function patchAll($data, $condition)
	{
		return $this->db->table($this->table)->update($data, $condition);
	}

	public function remove($id)
	{
		return $this->db->table($this->table)->delete(["id_framework" => $id]);
	}

	public function removeAll($id)
	{
		return $this->db->table($this->table)->delete($id);
	}

	public function get($data)
	{
		return $this->db->table($this->table)->where($data);
	}

	public function getdata($data)
	{
		return $this->db->table($this->table)->where($data)->get()->getResult();
	}

	public function getdatabyorder($data, $column, $asc)
	{
		return $this->db->table($this->table)->where($data)->orderBy($column, $asc)->get()->getResult();
	}
}
