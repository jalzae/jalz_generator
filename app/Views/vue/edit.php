<?php
$limit = count($column);
echo "&#13";
for ($i = 0; $i < $limit; $i++) {
    if ($namespace == "json") {
        echo '&#13"' . $column[$i]['Field'] . '":"",';
    } else {
        echo '&#13' . $column[$i]['Field'] . ':"",';
    }
}
