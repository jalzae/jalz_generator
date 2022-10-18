const express = require('express');

const router = express.Router();
const validate = require('../app/middlewares/validation');
const controller = require('../app/controllers/<?= $table ?>');
const validationRules = require('../app/validations/<?= $table ?>');

router.post(
'/',
validationRules.Create(),
validate,
controller.create,
);

router.get(
'/',
validationRules.FindAll(),
validate,
controller.findAll,
);

router.get(
'/:id',
validationRules.FindOne(),
validate,
controller.findOne,
);

router.put(
'/:id',
validationRules.Update(),
validate,
controller.update,
);

router.delete(
'/:id',
validationRules.Delete(),
validate,
controller.deleteById,
);

const routeProps = {
route: router,
needAuth: true,
};

module.exports = routeProps;
