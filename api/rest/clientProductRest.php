<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->list($request,$response);
});

