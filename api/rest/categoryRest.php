<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('', function (Request $request, Response $response, array $args) {
    $CategoryController = new CategoryController();
    return $CategoryController->list($request,$response);
});
$app->get('/{id}', function (Request $request, Response $response, array $args) {
    $CategoryController = new CategoryController();
    return $CategoryController->listById($request,$response,$args);
});
$app->post('', function (Request $request, Response $response, array $args) {
    $CategoryController = new CategoryController();
    return $CategoryController->add($request,$response);
});
$app->put('', function (Request $request, Response $response, array $args) {
    $CategoryController = new CategoryController();
    return $CategoryController->update($request,$response);
});
