<?php
echo "<?php

";
?>
use ResponseTrait;
public function __construct() {
$this-><?= $table ?>=new Modelhere;
}

public function add() {
<?= $this->include('ci4api/add') ?>
}

public function create() {
<?= $this->include('ci4api/create') ?>
}
public function read() {
<?= $this->include('ci4api/read') ?>
}
public function update() {
<?= $this->include('ci4api/update') ?>
}
public function delete() {
<?= $this->include('ci4api/delete') ?>
}
public function detail() {
<?= $this->include('ci4api/detail') ?>
}
}