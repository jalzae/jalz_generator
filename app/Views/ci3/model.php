<?php
echo '
protected $DBGroup = "default";
protected $table = "' . $table . '";
protected $primaryKey = "' . $column[0]['Field'] . '";
protected $useAutoIncrement = true;
protected $insertID = 1;
protected $returnType = "object";
protected $useSoftDeletes = false;
protected $protectFields = false;
protected $allowedFields = ["*"];

public function table()
{
return $this->db->from($this->table);
}

public function getall()
{
return $this->db->get($this->table);
}

public function getbyorder($column,$opsi)
{
    $this->db->order_by($column,$opsi);
return $this->db->get($this->table);
}

public function getrow($data)
{
    $this->db->where($data);
return $this->db->from($this->table)->first_row();
}

public function getrowlast($data)
{
    $this->db->where($data);
    $this->db->order_by("' . $column[0]['Field'] . '","DESC");
    return $this->db->from($this->table)->last_row();
}

public function put($data)
{
return $this->db->insert($this->table,$data);
}

public function putAll($data)
{
    
return $this->db->insert_batch($this->table,$data);
}

public function patch($data,$id)
{
    $this->db->where("' . $column[0]['Field'] . '",$id);
return $this->db->update($this->table,$data);
}

public function patchAll($data,$condition)
{
    $this->db->where($condition);
return $this->db->table($this->table,$data);
}

public function remove($id)
{
$this->db->where(["' . $column[0]['Field'] . '"=>$id]);
return $this->db->delete($this->table);
}

public function removeAll($id)
{
return $this->db->delete($this->table,$id);
}

public function get($data)
{
return $this->db->get_where($this->table,$data);
}

public function getdata($data)
{
    $this->db->where($data);
return $this->db->get($this->table);
}

public function getdatabyorder($data, $column, $asc)
{
    $this->db->where($data);
    $this->db->order_by($column, $asc);
return $this->db->get($this->table);
}

public function getdatabyorderjoin($data, $column, $asc,$table2,$cond)
{
    $this->db->where($data);
    $this->db->order_by($column, $asc);
    $this->db->join($table2,$cond);
return $this->db->get($this->table);
}


public function getjoin($table,$cond,$data)
{
    $this->db->where($data);
    $this->db->join($table,$cond);
return $this->db->get($this->table);
}


public function getjoin2($table,$cond,$table2,$cond2,$data)
{
return $this->db->table($this->table)->join($table,$cond)->join($table2,$cond2)->where($data);
}

';


echo 'function up(){
    return $this->db->query("CREATE TABLE `' . $table . '` (';
foreach ($column as $obj) {
    echo '`' . $obj['Field'] . '` ' . $obj['Type'] . ' ';
    if ($obj['Null'] == "NO") {
        echo 'NOT NULL ' . $obj['Extra'] . ',';
    } else {
        echo 'NULL ' . $obj['Extra'] . ',';
    }
}
echo '    PRIMARY KEY (`' . $column[0]['Field'] . '`)
      ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1");
    
    }
    
    ';
