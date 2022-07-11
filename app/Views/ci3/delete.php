<?php

$limit = 1;
for ($i = 0; $i < $limit; $i++) {

    echo '$' . $column[$i]['Field'] . '=$this->input->post("' . $column[$i]['Field'] . '");&#13;';
}



echo '&#13;$save=$this->model->' . $table . '->remove(["' . $column[0]['Field'] . '"=>$' . $column[0]['Field'] . ']);';
echo '&#13;if($save){
    echo "Berhasil Delete";
}
else {
    echo "Gagal Delete";
}';
