const { success } = require('../services/httpRes');
const repository = require('../repositories/<?= $table ?>');
const transactionRepo = require('../repositories/transaction');

const library = {};

library.create = async (req, res, next) => {
try {
const brand_id = req.headers['x-brand'];
data = {};
data.body = req.body;
data.body.brand_id = brand_id;

// start transaction
const transaction = await transactionRepo.Create();

if (!transaction.status) {
throw transaction.err;
}

const response = await repository.create(data.body, transaction.data);

if (!response.status) {
await transactionRepo.Rollback(transaction.data);
throw response.err;
}
await transactionRepo.Commit(transaction.data);

return success(res, 200, response);
} catch (err) {
return next(err);
}
};

library.update = async (req, res, next) => {
try {
const brand_id = req.headers['x-brand'];
data = {};
const { id } = req.params;
data.body = req.body;
data.body.brand_id = brand_id;

// start transaction
const transaction = await transactionRepo.Create();

if (!transaction.status) {
throw transaction.err;
}

const resp = await repository.findById(id, transaction.data);

if (!resp.status) {
return res.json(resp);
}

const response = await repository.update(data.body, transaction.data);

if (!response.status) {
await transactionRepo.Rollback(transaction.data);
throw response.err;
}
await transactionRepo.Commit(transaction.data);

return success(res, 200, response);
} catch (err) {
return next(err);
}
};

library.deleteById = async (req, res, next) => {
try {
data = {};
const { id } = req.params;

const transaction = await transactionRepo.Create();

if (!transaction.status) {
throw transaction.err;
}

const response = await repository.deleteById(id, transaction.data);

return success(res, 200, response);
} catch (err) {
return next(err);
}
};

library.findAll = async (req, res, next) => {
try {
const { page, per_page } = req.query;
const brand_id = req.headers['x-brand'];
const pagination = { page, per_page };

const transaction = await transactionRepo.Create();

if (!transaction.status) {
throw transaction.err;
}

const response = await repository.findAll({
params: {
...req.query,
brand_id,
},
pagination,
}, transaction.data);
return success(res, 200, response);
} catch (err) {
return next(err);
}
};
library.findOne = async (req, res, next) => {
try {

const { id } = req.params;
// start transaction
const transaction = await transactionRepo.Create();

if (!transaction.status) {
throw transaction.err;
}

const response = await repository.findById(id, transaction.data);

return success(res, 200, response);
} catch (err) {
return next(err);
}
};


module.exports = library;