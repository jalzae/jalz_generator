public function create()
{
$this->attributes['<?= $table ?>_createdby'] = $this->request->getVar('username');
;
$this->attributes['<?= $table ?>_updatedby'] = $this->request->getVar('username');
;
}

public function update()
{
$this->attributes['<?= $table ?>_updatedby'] = $this->request->getVar('username');
;
}

public function delete()
{
$this->attributes['<?= $table ?>_deletedby'] = $this->request->getVar('username');
;
}