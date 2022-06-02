<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('', function (Request $request, Response $response, array $args) {
    $ClientController = new ClientController();
    return $ClientController->addAddress($request,$response);
});
$app->get('', function (Request $request, Response $response, array $args) {
    $ClientController = new ClientController();
    return $response->withJson([], 200);
});
