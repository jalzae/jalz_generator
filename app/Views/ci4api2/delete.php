<?php

$limit = 1;
for ($i = 0; $i < $limit; $i++) {
    echo '$' . $column[$i]['Field'] . '=$this->request->getVar("' . $column[$i]['Field'] . '");&#13;';
}

echo '&#13;$save=$this->model->table("' . $table . '")->delete(["' . $column[0]['Field'] . '"=>$id]);';
echo '&#13;if($save){
    $message = [
        "status"=>200,
        "message" => "Sukses Delete",
     ];
     return $this->respond($message, 200);
}
else {
    $message = [
        "status"=>400,
        "message" => "Gagal Delete",
     ];
     return $this->respond($message, 400);
}';
