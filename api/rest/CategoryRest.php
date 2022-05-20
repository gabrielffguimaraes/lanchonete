<?php
require('./dao/CategoryDAO.php');
require('./controller/CategoryController.php');

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