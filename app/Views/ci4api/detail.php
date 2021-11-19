<?php

$limit = 1;
for ($i = 0; $i < $limit; $i++) {

    echo '$' . $column[$i]['Field'] . '=$this->request->getVar("' . $column[$i]['Field'] . '");&#13;';
}



echo '&#13;$data=$this->' . $table . '->getrow(["' . $column[0]['Field'] . '"=>$id]);&#13;';

echo '&#13;if(count($data)!=0){
    $message = [
       "message" => "Sukses",
       "data" => $data,
    ];
    return $this->respond($data, 200);
}
else if (count($data)==0){
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
