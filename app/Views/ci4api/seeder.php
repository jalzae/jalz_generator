public function run() {
$data=[
<?php
foreach ($data as $key => $value) {

  var_export($value);
  echo ",";
}

?>
];
$this->db->table('<?= $table ?>')->insertBatch($data);
}