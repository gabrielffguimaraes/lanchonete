<?php
use Slim\Http\Request;
use Slim\Http\Response;

/*$app->get('', function (Request $request, Response $response, array $args) {
    $ProductController = new ProductController();
    return $ProductController->list($request,$response);
});*/
$app->get('', '\ProductController:list');
$app->get('/{id}', '\ProductController:listById');
