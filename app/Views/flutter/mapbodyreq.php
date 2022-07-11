Map<String,String> bodyReq={
    <?php
    $limit = count($column);
    for ($i = 1; $i < $limit; $i++) {
        echo  '"' . $column[$i]['Field'] . '":"' . $column[$i]['Field'] . '",';
    }
    ?>
    };