<?php

$limit = 1;
for ($i = 0; $i < $limit; $i++) {

    echo '$' . $column[$i]['Field'] . '=$this->request->getVar("' . $column[$i]['Field'] . '");&#13;';
}



echo '&#13;$save=$this->' . $table . '->table()->delete(["' . $column[0]['Field'] . '"=>$' . $column[0]['Field'] . ']);';
echo '&#13;if($save){
    $message = [
        "message" => "Sukses Delete",
     ];
     return $this->respond($message, 200);
}
else {
    $message = [
        "message" => "Gagal Delete",
     ];
     return $this->respond($message, 400);
}';
