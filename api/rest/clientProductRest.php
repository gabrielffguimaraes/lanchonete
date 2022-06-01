<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->list($request,$response);
});
$app->get('/{id}', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->listById($request,$response,$args);
});
