public function __construct() {
    parent::__construct();
    $this->load->model(['<?= $table ?>']);
}

public function add() {
<?= $this->include('ci3/add') ?>
}

public function create() {
<?= $this->include('ci3/create') ?>
}
public function read() {
<?= $this->include('ci3/read') ?>
}
public function update() {
<?= $this->include('ci3/update') ?>
}
public function delete() {
<?= $this->include('ci3/delete') ?>
}
public function detail() {
<?= $this->include('ci3/detail') ?>
}