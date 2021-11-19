<?php
$limit = count($column);
echo "forms:{";
echo "&#13";
for ($i = 1; $i < $limit; $i++) {
    echo '&#13' . $column[$i]['Field'] . ':"",';
}
echo "}";
