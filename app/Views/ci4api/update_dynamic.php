<?php

$limit = count($column);
for ($i = 0; $i < 1; $i++) {
    if ($column[$i]['Type'] == 'datetime') {
        echo '$' . $column[$i]['Field'] . '=date("Y-m-d H:i:s");&#13;';
    } else {
        echo '$' . $column[$i]['Field'] . '=$this->request->getVar("' . $column[$i]['Field'] . '");&#13;';
    }
}
echo ' &#13$column = $this->request->getVar("column");
&#13
$value = $this->request->getVar("value");';

echo "&#13";
echo '$data=[';
for ($i = 0; $i < 1; $i++) {

    echo '&#13$column=>$value,';
}
echo '
];';

echo '&#13;$save=$this->' . $table . '->table()->update($data,["' . $column[0]['Field'] . '"=>$' . $column[0]['Field'] . ']);';

echo '&#13;if($save){
    $message = [
        "status"=>200,
       "message" => "Sukses",
       "data" => $data,
    ];
    return $this->respond($message, 200);
}
else {
    $message = [
        "status"=>400,
        "message" => "Gagal",
        "data" => $data,
     ];
     return $this->respond($message, 400);
}';
