<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('', function (Request $request, Response $response, array $args) {
    $clientController = new ClientController();
    return $clientController->addAddress($request,$response);
});
$app->put('/{id}', function (Request $request, Response $response, array $args) {
    $clientController = new ClientController();
    return $clientController->updateAddress($request,$response,$args);
});
$app->delete('/{id}', function (Request $request, Response $response, array $args) {
    $clientController = new ClientController();
    return $clientController->deleteAddress($request,$response,$args);
});
$app->get('', function (Request $request, Response $response, array $args) {
    $clientController = new ClientController();
    return $clientController->getAddresses($request,$response);
});
$app->get('/{id}', function (Request $request, Response $response, array $args) {
    $clientController = new ClientController();
    return $clientController->getAddress($request,$response,$args);
});
