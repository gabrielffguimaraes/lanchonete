<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->list($request,$response);
});
$app->post('/ingredient', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->addIngredientToProduct($request,$response);
});
$app->post('', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->add($request,$response);
});
