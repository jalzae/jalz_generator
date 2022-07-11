$page = $this->request->getVar('page');
$per_page = $this->request->getVar('per_page');

<?php

echo '$data=$this->model->pagination("' . $table . '",$page,$per_page);&#13;';

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
