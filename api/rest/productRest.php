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
$app->post('/ingredient', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->addIngredientToProduct($request,$response);
});
$app->post('', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->add($request,$response);
});
$app->post('/{id}', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->update($request,$response,$args);
});
$app->delete('/{id}', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->delete($request,$response,$args);
});
