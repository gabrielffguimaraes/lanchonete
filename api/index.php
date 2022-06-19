<?php
date_default_timezone_set('America/Sao_Paulo');
require('../vendor/autoload.php');

$app = new \Slim\App();

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/email', function(Request $request, Response $response, array $args) use ($app) {
    $authController = new AuthController();
    return $authController->sendRecoveryCode($request,$response);
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


$app->group('/client/product', function() use ($app) {
    include './rest/clientProductRest.php';
});

$app->group('/client/address', function() use ($app) {
    include './rest/clientAddressRest.php';
});

$app->group('/product', function() use ($app) {
    include './rest/productRest.php';
});

$app->group('/order', function() use ($app) {
    include './rest/orderRest.php';
});



/*
$app->group('/categoria', function() use ($app) {
    $app->get('/', function (Request $request, Response $response, array $args) {
        $LoginController = new LoginController();
        return $LoginController->registerUser($request,$response);
    });
});
*/



$app->run();
