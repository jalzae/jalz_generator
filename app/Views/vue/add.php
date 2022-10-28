<?php
$limit = count($column);
echo "forms:{";
echo "&#13";
for ($i = 1; $i < $limit; $i++) {
    if ($namespace == "json") {
        echo '&#13"' . $column[$i]['Field'] . '":"",';
    } else {
        echo '&#13' . $column[$i]['Field'] . ':"",';
    }
}
echo "}";
