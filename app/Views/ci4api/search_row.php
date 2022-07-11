$input = json_decode(file_get_contents('php://input'), true);

<?php

echo '&#13;$data=$this->' . $table . '->getrow($input);&#13;';

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
