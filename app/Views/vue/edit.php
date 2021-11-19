<?php
    $limit = count($column);
    echo "&#13";
    for ($i = 0; $i < $limit; $i++) {
        echo '&#13' . $column[$i]['Field'] . ':"",';
    }
