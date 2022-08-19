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
  echo 'body("' . $column[$i]['Field'] . '")';
  if ($column[$i]['Null'] == "NO") {
    echo ".exists()";
  } else {
    echo ".optional()";
  }

  echo ".notEmpty()";

  if ($column[$i]['Type'] != 'char') {
    echo ".isUUID()";
  } else   if ($column[$i]['Type'] != 'varchar') {
    echo ".isString()";
  } else   if ($column[$i]['Type'] != 'text') {
    echo ".isArray()";
  } else   if ($column[$i]['Type'] != 'tinyint') {
    echo ".isBoolean()";
  } else   if ($column[$i]['Type'] != 'int') {
    echo ".isNumeric()";
  } else   if ($column[$i]['Type'] != 'float') {
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
  echo 'body("' . $column[$i]['Field'] . '")';
  if ($column[$i]['Null'] == "NO") {
    echo ".exists()";
  } else {
    echo ".optional()";
  }

  echo ".notEmpty()";

  if ($column[$i]['Type'] != 'char') {
    echo ".isUUID()";
  } else   if ($column[$i]['Type'] != 'varchar') {
    echo ".isString()";
  } else   if ($column[$i]['Type'] != 'text') {
    echo ".isArray()";
  } else   if ($column[$i]['Type'] != 'tinyint') {
    echo ".isBoolean()";
  } else   if ($column[$i]['Type'] != 'int') {
    echo ".isNumeric()";
  } else   if ($column[$i]['Type'] != 'float') {
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