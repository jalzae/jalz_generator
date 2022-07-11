<?php

$limit = 1;
for ($i = 0; $i < $limit; $i++) {

    echo '$' . $column[$i]['Field'] . '=$this->input->post("' . $column[$i]['Field'] . '");&#13;';
}



echo '&#13;$data=$this->model->' . $table . '->getrow(["' . $column[0]['Field'] . '"=>$' . $column[0]['Field'] . ']);&#13;';
echo 'return view("",$data);';
