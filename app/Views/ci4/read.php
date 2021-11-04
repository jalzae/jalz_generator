<?php


echo '$data["'.$table.'"]=$this->' . $table . '->getall();&#13;';
echo 'return view("",$data);';
