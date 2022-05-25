<?php
require('./dao/IngredientDAO.php');
require('./controller/IngredientController.php');

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('', function (Request $request, Response $response, array $args) {
    $IngredientController = new IngredientController();
    return $IngredientController->list($request,$response);
});
$app->get('/{id}', function (Request $request, Response $response, array $args) {
    $IngredientController = new IngredientController();
    return $IngredientController->listById($request,$response,$args);
});
$app->post('', function (Request $request, Response $response, array $args) {
    $IngredientController = new IngredientController();
    return $IngredientController->add($request,$response);
});
$app->put('', function (Request $request, Response $response, array $args) {
    $IngredientController = new IngredientController();
    return $IngredientController->update($request,$response);
});
