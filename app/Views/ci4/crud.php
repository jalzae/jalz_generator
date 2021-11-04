public function __construct() {
$this-><?=$table?>=new Modelhere;
}

public function create() {
<?= $this->include('ci4/create') ?>
}
public function read() {
<?= $this->include('ci4/read') ?>
}
public function update() {
<?= $this->include('ci4/update') ?>
}
public function delete() {
<?= $this->include('ci4/delete') ?>
}
public function detail() {
<?= $this->include('ci4/detail') ?>
}