<?php

$limit = count($column);
for ($i = 0; $i < $limit; $i++) {
    if ($column[$i]['Type'] == 'datetime') {
        echo '$' . $column[$i]['Field'] . '=date("Y-m-d H:i:s");&#13;';
    } else {
        echo '$' . $column[$i]['Field'] . '=$this->request->getVar("' . $column[$i]['Field'] . '");&#13;';
    }
}

echo "&#13";
echo '$data=[';
for ($i = 1; $i < $limit; $i++) {

    echo '&#13"' . $column[$i]['Field'] . '"=>$' . $column[$i]['Field'] . ',';
}
echo '
];';


echo '&#13;$save=$this->' . $table . '->table()->update($data,["'. $column[0]['Field'].'"=>$'. $column[0]['Field'].']);';
echo '&#13;if($save){
    echo "Berhasil Update";
}
else {
    echo "Gagal Update";
}';
