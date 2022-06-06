<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('', function (Request $request, Response $response, array $args) {
    $orderController = new OrderController();
    return $orderController->create($request,$response);
});

