<?php

namespace App\Libraries;

class Entities
{

  static $sample = [
    'enc' => ['id', 'id_bank'],
    'hide' => ['entry_date', 'entry_user', 'update_user', 'update_date', 'delete_user', 'delete_date'],
    ///sample variable casting 
    'int' => [],
    'string' => [],
    'float' => [],
    'bool' => []
  ];

  public static function data_validation()
  {
    $validation = [
      'sample' => self::$sample
    ];

    return $validation;
  }
}
