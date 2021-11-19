<?php

echo '$routes->get("/' . $table . '", "' . $table . '::read");
';
echo '$routes->post("/create' . $table . '", "' . $table . '::create");
';
echo '$routes->patch("/update' . $table . '", "' . $table . '::update");
';
echo '$routes->post("/delete' . $table . '", "' . $table . '::delete");
';
echo '$routes->get("/detail' . $table . '/(:any)", "' . $table . '::detail/$1");
';
