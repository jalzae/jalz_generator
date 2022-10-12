$page = ($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $per_page = ($this->request->getVar('per_page')) ? $this->request->getVar('per_page') : 10;
        $params = ($this->request->getVar('params')) ? $this->request->getVar('params') : [];
<?php

echo '$data=$this->model->paging_all("' . $table . '",$page,$per_page,$params);&#13;';

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
