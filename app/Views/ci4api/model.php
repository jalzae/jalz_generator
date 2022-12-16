<?php
echo '
protected $DBGroup = "default";
protected $table = "' . $table . '";
protected $primaryKey = "' . $column[0]['Field'] . '";
protected $useAutoIncrement = true;
protected $insertID = 1;
protected $returnType = "App\Entities\"' . ucfirst($table) . '";
protected $useSoftDeletes = true;
protected $useTimestamps = true;
protected $allowedFields = [
    ';
foreach ($column as $obj) {
    echo '"' . $obj['Field'] . '",';
}
echo '
];
protected $createdField  = "' . $table . '_createdat";
    protected $updatedField  = "' . $table . '_updatedat";
    protected $deletedField  = "' . $table . '_deletedat";';

foreach ($column as $obj) {
    echo "protected $" . str_replace('_', '', $obj['Field']) . ";";
}

echo '
public function table()
{
return $this->db->table($this->table);
}

public function getall()
{
return $this->db->table($this->table)->get()->getResult();
}

public function getallsort($column,$sort)
{
return $this->db->table($this->table)->orderBy($column,$sort)->get()->getResult();
}

public function getbyorder($column,$opsi)
{
return $this->db->table($this->table)->orderBy($column,$opsi)->get()->getResult();
}

public function getrow($data)
{
return $this->db->table($this->table)->where($data)->get(1)->getRowArray();
}

public function getrowlast($data)
{
return $this->db->table($this->table)->where($data)->orderBy("' . $column[0]['Field'] . '","DESC")->get(1)->getRowArray();
}

public function put($data)
{
return $this->db->table($this->table)->insert($data);
}

public function putAll($data)
{
return $this->db->table($this->table)->insertBatch($data);
}

public function patch($data,$id)
{
return $this->db->table($this->table)->update($data,["' . $column[0]['Field'] . '"=>$id]);
}

public function patchAll($data,$condition)
{
return $this->db->table($this->table)->update($data,$condition);
}

public function remove($id)
{
return $this->db->table($this->table)->delete(["' . $column[0]['Field'] . '"=>$id]);
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

public function getjoin($table,$cond,$data)
{
return $this->db->table($this->table)->join($table,$cond)->where($data);
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


echo 'function down(){
return $this->db->query("DROP TABLE `' . $table . '`");

}

';
?>

public static function Paging_All($array, $per_page)
{
$dataarray = array_chunk($array, $per_page);
$data = [
'per_page' => $per_page,
'total_data' => count($array),
'total_page' => ceil(count($array) / $per_page),
'data' => $dataarray,
];
return $data;
}

public static function Paging($array,$start, $per_page)
{
$dataarray = array_slice($array,$start,$per_page);
$data = [
'per_page' => $per_page,
'total_data' => count($array),
'total_page' => ceil(count($array) / $per_page),
'data' => $dataarray,
];
return $data;
}

public static validator(){
<?php

if ($namespace != "1") {

    $limit = count($column);
    echo '$rule=[';

    for ($i = 1; $i < $limit; $i++) {
        if ($column[$i]['Null'] == "NO") {
            echo '&#13"' . $column[$i]['Field'] . '"=>"required",';
        }
    }

    echo '&#13;];&#13;';

    echo '$error=[';
    for ($i = 1; $i < $limit; $i++) {
        if ($column[$i]['Null'] == "NO") {
            print_r('&#13;"' .  $column[$i]['Field'] . '"=>[
            "required"  => "' .  $column[$i]['Field'] . ' wajib diisi."
        ],');
        }
    }

    echo '&#13;];&#13;';
} else {
    $limit = count($column);
    echo '$rule=[';

    for ($i = 1; $i < $limit; $i++) {

        echo '&#13"' . $column[$i]['Field'] . '"=>"required",';
    }

    echo '&#13;];&#13;';

    echo '$error=[';
    for ($i = 1; $i < $limit; $i++) {

        print_r('&#13;"' .  $column[$i]['Field'] . '"=>[
            "required"  => "' .  $column[$i]['Field'] . ' wajib diisi."
        ],');
    }

    echo '&#13;];&#13;';
}

?>
return ['rule' => $rule, 'error' => $error];

}