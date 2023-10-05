static public function setup()
{
$setup = [
"table" => "<?= $table ?>",
"datatype" => "char",
"paranoid" => true,
"entry_field" => "entry_date",
"update_field" => "update_date",
"delete_field" => "delete_date",
];
return $setup;
}


static public function init()
{
return [
<?php
function splitType(string $inputString)
{
  if (strpos($inputString, '(') !== false && strpos($inputString, ')') !== false) {
    // Extract data type and length from the input string
    preg_match('/([a-zA-Z]+)\((\d+)\)/', $inputString, $matches);
    if (count($matches) === 3) {
      $status = true;
      $result = [$matches[1], (int)$matches[2]];
    } else {
      // If the regular expression didn't match correctly
      $status = false;
      $result = [$inputString];
    }
  } else {
    // If no parentheses are found, consider the whole string as the data type
    $status = false;
    $result = [$inputString];
  }

  return ['status' => $status, 'result' => $result];
}

function typeDetect(string $type, int $constraint = 0): string
{
  if (($type == 'CHAR' || $type == 'char') && $constraint == 36) {
    return 'enc';
  } else if ($type == 'int') {
    return 'int';
  } else if ($type == 'varchar') {
    return 'string';
  } else if ($type == 'text') {
    return 'string';
  } else if ($type == 'datetime') {
    return 'string';
  } else if ($type == 'date') {
    return 'string';
  } else if ($type == 'year') {
    return 'string';
  } else {
    return 'string';
  }
}

foreach ($column as $obj) {
  if ($obj['Field'] != 'entry_date' || $obj['Field'] != 'update_date' || $obj['Field'] != 'delete_date') {
?>
    '<?= $obj['Field'] ?>' => [
    <?php
    $resultType = splitType($obj['Type']);
    $statusResult = $resultType['status'];
    $type = '';
    if ($statusResult) {
      $type = typeDetect($resultType['result'][0], $resultType['result'][1] ?? 0);
    } else {
      $type = typeDetect($resultType['result'][0]);
    }
    echo "'type'=>'" . $type . "',";
    echo "'datatype' => '" . $resultType['result'][0] . "',";

    if (isset($resultType['result'][1])) {
      if (($resultType['result'][1] != 11 && $resultType['result'][0] != 'int') || $resultType['result'][0] != 'text' || $resultType['result'][0] != 'datetime' || $resultType['result'][0] != 'date') {
        echo "'constraint' => '" . $resultType['result'][1] . "',";
      }
    }

    ?>
    <?= ($obj['Key'] == "PRI") ? "'primary_key' => true," : '' ?>
    <?= ($obj['Null'] == "NO") ? "'required' => 'required'," : '' ?>
    ],

<?php }
} ?>

];
}