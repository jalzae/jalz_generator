	<?php


  echo "{";
  $index = 0;
  foreach ($column as $obj) {
    echo "
	";
    echo $obj['Field'] . ': {
	';

    //Define type
    if ($obj['Type'] == "char(36)") {
      echo "type : DataTypes.UUID,
	";
      if ($index == 0) {
      }
    } else if ($obj['Type'] == "string") {
      echo "type : DataTypes.STRING,
	";
    } else if ($obj['Type'] == "varchar") {
      echo "type : DataTypes.STRING(" . $obj['contraits'] . "),
	";
    } else if ($obj['Type'] == "int") {
      echo "type : DataTypes.INTEGER,
	";
    } else if ($obj['Type'] == "bool") {
      echo "type : DataTypes.BOOLEAN,
	";
    } else if ($obj['Type'] == "enum") {
      echo "type : DataTypes.ENUM(" . str_replace('/', ',', $obj['enum']) . "),
	";
    } else if ($obj['Type'] == "json") {
      echo "type : DataTypes.TEXT('LONG'),
	";
    } else if ($obj['Type'] == "datetime") {
      echo "type : DataTypes.DATE,
	";
    }

    //Define Default Value or not
    if ($obj['Default'] != null) {
      echo "defaultValue:" . $obj['default'] . ",
	";
    }

    //Define Null or not
    if ($obj['Null'] == "YES") {
      echo "allowNull:true,
	";
    }

    //Define primary key
    if ($obj['Key'] == "PRI") {
      echo "primaryKey:true,
	";
    }
    if (array_key_exists('Unique', $obj)) {
      if ($obj['Unique'] == "true") {
        echo "unique:true,
	";
      }
    }

    //Define auto_increment
    if (array_key_exists('Auto_Increment', $obj)) {
      if ($obj['Auto_Increment'] == "true") {
        echo "autoIncrement:true,
	";
      }
    }
    echo "},
	";
    $index++;
  }
  echo "},";
