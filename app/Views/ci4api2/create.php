<?php

$limit = count($column);
for ($i = 1; $i < $limit; $i++) {
    if ($column[$i]['Type'] == 'datetime') {
        echo '$' . $column[$i]['Field'] . '=date("Y-m-d H:i:s");&#13;';
    } else {
        echo '$' . $column[$i]['Field'] . '=$this->request->getVar("' . $column[$i]['Field'] . '");&#13;';
    }
}

echo "&#13";
echo '$data=[';
for ($i = 1; $i < $limit; $i++) {

    echo '&#13"' . $column[$i]['Field'] . '"=>$' . $column[$i]['Field'] . ',';
}
echo '
];';

echo 'if ($this->validation->run($data, "' . $table . '") == false) {
    $response = [
        "status"=>400,
        "message" =>  $this->validation->getErrors(),
    ];
    return $this->respond($response, 400);
} else {';
echo '&#13;$save=$this->model->put("' . $table . ',$data);';
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
}}';
