<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/ingredient', 'ProductController:addIngredientToProduct')->add(Authmethods::basicAuth(['employee']));
$app->post('', 'ProductController:add')->add(Authmethods::basicAuth(['employee']));
$app->post('/{id}', 'ProductController:update')->add(Authmethods::basicAuth(['employee']));
$app->get('', 'ProductController:list');
$app->get('/{id}', 'ProductController:listById');
$app->delete('/{id}', 'ProductController:delete')->add(Authmethods::basicAuth(['employee']));
