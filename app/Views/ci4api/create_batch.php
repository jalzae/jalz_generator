$remap = [];
$input = json_decode(file_get_contents('php://input'), true);
$newdate = date('Y-m-d H:i:s');
foreach ($input as $obj) {
$values = [
<?php
for ($i = 1; $i < $limit; $i++) {
    if ($column[$i]['Field'] == "update_date") {
        echo '&#13"' . $column[$i]['Field'] . '"=>$newdate,';
    } else if ($column[$i]['Field'] == "entry_date") {
        echo '&#13"' . $column[$i]['Field'] . '"=>$newdate,';
    } else {
        echo '&#13"' . $column[$i]['Field'] . '"=>$obj["' . $column[$i]['Field'] . '"],';
    }
}
?>
];
array_push($remap, $values);
}

<?php

echo '&#13;$save=$this->' . $table . '->putAll($remap);&#13;';

echo '&#13;if($save){
    $message = [
        "status"=>200,
       "message" => "Sukses",
       "data" => $remap,
    ];
    return $this->respond($message, 200);
}
else {
    $message = [
        "status"=>400,
        "message" => "Gagal",
        "data" => [],
     ];
     return $this->respond($message, 400);
}';
