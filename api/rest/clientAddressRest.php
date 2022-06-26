<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('', 'ClientController:addAddress');
$app->put('/{id}', 'ClientController:updateAddress');
$app->delete('/{id}', 'ClientController:deleteAddress');
$app->get('', 'ClientController:getAddresses');
$app->get('/{id}', 'ClientController:getAddress');
