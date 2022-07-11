<?php
if ($namespace == "1") {
?>
    public function __construct() {
    $this->model=new Modelhere;
    }
    
    public function create() {
    <?= $this->include('ci4api2/create') ?>
    }

    public function pagination() {
    <?= $this->include('ci4api2/pagination') ?>
    }

    public function read() {
    <?= $this->include('ci4api2/read') ?>
    }

    public function update() {
    <?= $this->include('ci4api2/update') ?>
    }

    public function update_dynamic() {
    <?= $this->include('ci4api2/update_dynamic') ?>
    }

    public function delete($id="null") {
    <?= $this->include('ci4api2/delete') ?>
    }

    public function detail($id="null") {
    <?= $this->include('ci4api2/detail') ?>
    }

    public function search() {
    <?= $this->include('ci4api2/search') ?>
    }

    public function search_row() {
    <?= $this->include('ci4api2/search_row') ?>
    }

    public function create_batch() {
    <?= $this->include('ci4api2/create_batch') ?>
    }

<?php
} else {
?>

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

    public function update_dynamic() {
    <?= $this->include('ci4api/update_dynamic') ?>
    }

    public function delete($id="null") {
    <?= $this->include('ci4api/delete') ?>
    }

    public function detail($id="null") {
    <?= $this->include('ci4api/detail') ?>
    }

    public function search() {
    <?= $this->include('ci4api/search') ?>
    }

    public function search_row() {
    <?= $this->include('ci4api/search_row') ?>
    }

    public function create_batch() {
    <?= $this->include('ci4api/create_batch') ?>
    }

<?php } ?>