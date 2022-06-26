<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('', 'IngredientController:list');
$app->get('/{id}', 'IngredientController:listById');
$app->post('', 'IngredientController:add')->add(Authmethods::basicAuth(['employee']));
$app->put('', 'IngredientController:update')->add(Authmethods::basicAuth(['employee']));
