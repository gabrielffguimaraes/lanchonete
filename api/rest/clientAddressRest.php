<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('', function (Request $request, Response $response, array $args) {
    $clientController = new ClientController();
    return $clientController->addAddress($request,$response);
});
$app->get('', function (Request $request, Response $response, array $args) {
    $clientController = new ClientController();
    return $clientController->getAddresses($request,$response);
});
