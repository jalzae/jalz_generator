const flaverr = require('flaverr');

const { <?= $namespace ?> } = require('../models');

const create = async (data, transaction) => {
try {
const {
<?php
for ($i = 1; $i < $limit; $i++) {
  echo $column[$i]['Field'] . ',';
}
?>
} = data;

const payload = {
<?php
for ($i = 1; $i < $limit; $i++) {
  echo $column[$i]['Field'] . ',';
}
?>
};
const respons = await <?= $namespace ?>.create(payload, transaction);

return {
status: true,
data: respons,
};
} catch (err) {
return {
status: false,
err,
};
}
};

const update = async (data, transaction) => {
try {
const {
<?php
for ($i = 0; $i < $limit; $i++) {
  echo $column[$i]['Field'] . ',';
}
?>
} = data;

const payload = {
<?php
for ($i = 0; $i < $limit; $i++) {
  echo $column[$i]['Field'] . ',';
}
?>
};

const respons = await <?= $namespace ?>.update(payload, { where: { id },returning:true }, transaction);

return {
status: true,
data: respons,
};
} catch (err) {
return {
status: false,
err,
};
}
};

const findAll = async (data = { params: {}, pagination: {} }, transaction) => {
try {
const { params, pagination } = data;
const where = {};

const page = pagination.page ? Number.parseInt(pagination.page) : 1;
const per_page = pagination.per_page ? Number.parseInt(pagination.per_page) : 10;

const { count, rows } = await <?= $namespace ?>.findAndCountAll({
where,
offset: (page - 1) * per_page,
limit: per_page,
transaction,
});
if (count < 1) throw flaverr('E_NOT_FOUND', Error(`<?= $namespace ?> not found`)); 

const result=paginate({
   data: rows, count, page, per_page,
 });
 return { 
  status: true, data: result, 
}; } 
catch (err) { 
  return { status: false, err, };
 }
 };
 
const findById=async (id, transaction)=> {
  try {
  const respons = await <?= $namespace ?>.findOne({ where: { id } }, transaction);

  if (respons == null) {
  return {
  status: false,
  data: respons,
  message: `not found ID:${id} `,
  };
  }

  return {
  status: true,
  data: respons,
  };
  } catch (err) {
  return {
  status: false,
  err,
  };
  }
  };

  const deleteById = async (id, transaction) => {
  try {
  const respons = await <?= $namespace ?>.destroy({ where: { id } }, transaction);

  if (respons == 0) {
  return {
  status: false,
  data: respons,
  message: `not found ID:${id} to delete`,
  };
  }

  return {
  status: true,
  data: respons,
  };
  } catch (err) {
  return {
  status: false,
  err,
  };
  }
  };

  module.exports = {
  create,
  update,
  findAll,
  findById,
  deleteById,
  };