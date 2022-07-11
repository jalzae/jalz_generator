<?php

$limit = 1;
for ($i = 0; $i < $limit; $i++) {

    echo '$id=$this->request->getVar("' . $column[$i]['Field'] . '");&#13;';
}



echo '&#13;$data=$this->model->getrow("' . $table . '",["' . $column[0]['Field'] . '"=>$id]);&#13;';

echo '&#13;if($data){
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
        "data" => [],
     ];
     return $this->respond($message, 400);
}';
