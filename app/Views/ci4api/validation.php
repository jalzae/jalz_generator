<?php
if ($namespace != "1") {

    $limit = count($column);
    echo '&#13;&#13;public $' . $table . '=[';

    for ($i = 1; $i < $limit; $i++) {
        if ($column[$i]['Null'] == "NO") {
            echo '&#13"' . $column[$i]['Field'] . '"=>"required",';
        }
    }

    echo '&#13;];&#13;';

    echo '&#13;&#13;public $' . $table . '_errors=[';
    for ($i = 1; $i < $limit; $i++) {
        if ($column[$i]['Null'] == "NO") {
            print_r('&#13;"' .  $column[$i]['Field'] . '"=>[
            "required"  => "' .  $column[$i]['Field'] . ' wajib diisi."
        ],');
        }
    }

    echo '&#13;];&#13;';
} else {
    $limit = count($column);
    echo '&#13;&#13;public $' . $table . '=[';

    for ($i = 1; $i < $limit; $i++) {

        echo '&#13"' . $column[$i]['Field'] . '"=>"required",';
    }

    echo '&#13;];&#13;';

    echo '&#13;&#13;public $' . $table . '_errors=[';
    for ($i = 1; $i < $limit; $i++) {

        print_r('&#13;"' .  $column[$i]['Field'] . '"=>[
            "required"  => "' .  $column[$i]['Field'] . ' wajib diisi."
        ],');
    }

    echo '&#13;];&#13;';
}
