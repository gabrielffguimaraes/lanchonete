<?php

use Slim\Http\Request;
use Slim\Http\Response;


$app->post('/{order_id}/status/{status}', function (Request $request, Response $response, array $args) {
    $orderController = new OrderController();
    return $orderController->addStatus($request,$response,$args);
});
$app->post('', function (Request $request, Response $response, array $args) {
    $orderController = new OrderController();

    return $orderController->create($request,$response);
});
$app->get('', function (Request $request, Response $response, array $args) {
    $orderController = new OrderController();
    return $orderController->list($request,$response);
});
$app->get('/frete/{cep}', function (Request $request, Response $response, array $args) {
    $orderController = new OrderController();
    return $orderController->calcularFrete($request,$response,$args);
});
$app->get('/manager', function (Request $request, Response $response, array $args) {
    $orderController = new OrderController();
    return $orderController->listAll($request,$response);
});
