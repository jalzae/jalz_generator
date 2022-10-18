const {
body, query, param, header,
} = require('express-validator');

const Create = () => [
header('x-brand')
.exists()
.notEmpty()
.isUUID(),
<?php
$limit = count($column);
for ($i = 1; $i < $limit; $i++) {
  echo "body('";
  echo $column[$i]['Field'];
  echo "')";
  if ($column[$i]['Null'] == "NO") {
    echo ".exists()";
  } else {
    echo ".optional()";
  }

  echo ".notEmpty()";

  if (strpos($column[$i]['Type'], 'char(36)') == 0) {
    echo ".isUUID()";
  } else   if (strpos($column[$i]['Type'], 'varchar') == 0) {
    echo ".isString()";
  } else   if (strpos($column[$i]['Type'], 'text') == 0) {
    echo ".isArray()";
  } else   if ($column[$i]['Type'] == 'tinyint(1)') {
    echo ".isBoolean()";
  } else   if ($column[$i]['Type'] == 'datetime') {
    echo ".isString()";
  } else   if (strpos($column[$i]['Type'], 'enum') == 0) {
    $str = $column[$i]['Type'];
    $from = '(';
    $to = ')';
    $sub = substr($str, strpos($str, $from) + strlen($from), strlen($str));
    echo ".isString().inIn([" .  substr($sub, 0, strpos($sub, $to)) . "])";
  } else   if (strpos($column[$i]['Type'], 'int') == 0) {
    echo ".isNumeric()";
  } else   if (strpos($column[$i]['Type'], 'float') == 0) {
    echo ".isNumeric()";
  }

  echo ",";
}
?>
];

const FindAll = () => [
query('page')
.optional()
.notEmpty()
.isInt({ min: 1 }),
query('per_page')
.optional()
.notEmpty()
.isInt({ min: 1 }),
header('x-brand')
.exists()
.notEmpty()
.isUUID(),
];

const FindOne = () => [
param('id')
.exists()
.notEmpty()
.isUUID()
.withMessage('please input a valid id'),
];

const Update = () => [
header('x-brand')
.exists()
.notEmpty()
.isUUID(),
param('id')
.exists()
.notEmpty()
.isUUID()
.withMessage('please input a valid id'),
<?php
$limit = count($column);
for ($i = 0; $i < $limit; $i++) {
  echo "body('";
  echo $column[$i]['Field'];
  echo "')";
  if ($column[$i]['Null'] == "NO") {
    echo ".exists()";
  } else {
    echo ".optional()";
  }

  echo ".notEmpty()";

  if (strpos($column[$i]['Type'], 'char(36)') == 0) {
    echo ".isUUID()";
  } else   if (strpos($column[$i]['Type'], 'varchar') == 0) {
    echo ".isString()";
  } else   if (strpos($column[$i]['Type'], 'text') == 0) {
    echo ".isArray()";
  } else   if ($column[$i]['Type'] == 'tinyint(1)') {
    echo ".isBoolean()";
  } else   if ($column[$i]['Type'] == 'datetime') {
    echo ".isString()";
  } else   if (strpos($column[$i]['Type'], 'enum') == 0) {
    $str = $column[$i]['Type'];
    $from = '(';
    $to = ')';
    $sub = substr($str, strpos($str, $from) + strlen($from), strlen($str));
    echo ".isString().inIn([" .  substr($sub, 0, strpos($sub, $to)) . "])";
  } else   if (strpos($column[$i]['Type'], 'int') == 0) {
    echo ".isNumeric()";
  } else   if (strpos($column[$i]['Type'], 'float') == 0) {
    echo ".isNumeric()";
  }

  echo ",";
}
?>
];

const Delete = () => [
param('id')
.exists()
.notEmpty()
.isUUID()
.withMessage('please input a valid id'),
];

module.exports = {
Create,
FindAll,
FindOne,
Update,
Delete,
};