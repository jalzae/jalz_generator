<?php


echo '$data=$this->' . $table . '->getall();&#13;';

echo '&#13;if($data){
    $message = [
       "message" => "Sukses",
       "data" => $data,
       "status"=>200,
    ];
    return $this->respond($message, 200);
}
else {
    $message = [
        "status"=>200,
        "message" => "Data kosong",
        "data" => $data,
     ];
     return $this->respond($message, 200);
}';
