<?php
date_default_timezone_set('America/Sao_Paulo');
require('../vendor/autoload.php');

$app = new \Slim\App();
$enviroments = require __DIR__. '/../app/enviroments.php';

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/status', function(Request $request, Response $response, array $args) use ($app) {
    $statusController = new StatusController();
    return $statusController->list($request,$response);
})->add(Authmethods::basicAuth(['client']));

$app->post('/email', function(Request $request, Response $response, array $args) use ($app) {
    $authController = new AuthController();
    return $authController->subscription($request,$response);
});

$app->group('/client/auth', function() use ($app) {
    include './rest/loginRest.php';
});

$app->group('/category', function() use ($app) {
    include './rest/categoryRest.php';
});

$app->group('/ingredient', function() use ($app) {
    include './rest/ingredientRest.php';
});

$app->group('/client/address', function() use ($app) {
    include './rest/clientAddressRest.php';
})->add(Authmethods::basicAuth(['client']));

$app->group('/product', function() use ($app) {
    include './rest/productRest.php';
});

$app->group('/order', function() use ($app) {
    include './rest/orderRest.php';
});

$app->group('/management', function() use ($app) {
    include './rest/managementRest.php';
})->add(Authmethods::basicAuth(['employee']));

// Get container
$container = $app->getContainer();
$container['notFoundHandler'] = function ($c) use ($enviroments){
    return function ($request, $response) use ($c,$enviroments) {
        return $response->withRedirect("{$enviroments['baseUrl']}404");
    };
};

$app->run();
