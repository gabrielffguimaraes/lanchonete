<?php

use Slim\Http\Request;
use Slim\Http\Response;


$app->post('/{order_id}/status', 'OrderController:updateOrderStatus')->add(Authmethods::basicAuth(['employee']));
$app->post('', 'OrderController:create')->add(Authmethods::basicAuth(['client']));

$app->get('', 'OrderController:list')->add(Authmethods::basicAuth(['client','employee']));
$app->get('/frete/{cep}', 'OrderController:calcularFrete');
$app->get('/manager', 'OrderController:listAll')->add(Authmethods::basicAuth(['employee']));
$app->get('/status', 'OrderController:listStatus')->add(Authmethods::basicAuth(['employee']));

$app->delete('/{order_id}/status', 'OrderController:cancelOrder')->add(Authmethods::basicAuth(['employee']));
