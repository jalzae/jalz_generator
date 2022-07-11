<?php


echo '$data["'.$table.'"]=$this->model->' . $table . '->getall();&#13;';
echo 'return view("",$data);';
