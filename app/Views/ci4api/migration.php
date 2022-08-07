public function up() {
$this->forge->addField([
<?php
foreach ($column as $obj) {
    echo '"' . $obj['Field'] . '"=>[';
    if ($obj['Field'] != 'update_date' || $obj['Field'] != 'entry_date' || $obj['Field'] != 'delete_date' || $obj['Field'] != 'entry_user' || $obj['Field'] != 'update_user' || $obj['Field'] != 'delete_user') {
        echo '"type" =>"' . trim(strtoupper(strtok($obj['Type'], '('))) . '",';

        if ($obj['Type'] != 'datetime') {
            echo
            '"constraint" =>' . preg_replace('/[()]/', ' ', trim(strstr($obj['Type'], '('))) . ',';
        }

        if ($obj['Null'] == "NO") {
            echo '"null" =>false,';
        } else {
            echo '"null" =>true,';
        }

        if ($obj['Default'] != null) {
            echo '"default" =>"' . $obj['Default'] . '",';
        }

        if ($obj['Extra'] == 'auto_increment') {
            echo '"auto_increment" =>true,';
        }
    } else if ($obj['Field'] == 'update_date' || $obj['Field'] == 'entry_date') {
        echo " 
				'type'       => 'DATETIME',
				'null' => false,
				'on update' => 'NOW()'
			";
    } else if ($obj['Field'] == 'update_user' || $obj['Field'] == 'entry_user') {
        echo "
				'type'       => 'VARCHAR',
				'constraint' => '200',
				'null' => false,
			";
    } else if ($obj['Field'] == 'delete_date') {
        echo " 
				'type'       => 'DATETIME',
				'null' => true,
				'default' => null,
			";
    } else if ($obj['Field'] == 'delete_user') {
        echo "
				'type'       => 'VARCHAR',
				'constraint' => '200',
				'null' => true,
				'default' => null
			";
    } else {
        echo "Method not found!!";
    }

    echo '],
    ';
}

?>
]);
$this->forge->addPrimaryKey('<?= $column[0]['Field'] ?>', true);
$attributes = ['ENGINE' => 'InnoDB'];
$this->forge->createTable('<?= $table ?>',false,$attributes);
}

public function down() {
$this->forge->dropTable('<?= $table ?>',true);
}