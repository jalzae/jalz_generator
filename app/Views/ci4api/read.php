<?php


echo '$data["' . $table . '"]=$this->' . $table . '->getall();&#13;';

echo '&#13;if(count($data["' . $table . '"])!=0){
    $message = [
       "message" => "Sukses",
       "data" => $data,
    ];
    return $this->respond($data, 200);
}
else if (count($data["' . $table . '"])==0){
    $message = [
        "message" => "Sukses, but no data here",
        "data" => "No Data",
     ];
     return $this->respond($message, 201);
}
else {
    $message = [
        "message" => "Gagal",
        "data" => "No Data",
     ];
     return $this->respond($message, 400);
}';
