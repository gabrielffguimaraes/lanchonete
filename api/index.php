<?php

require('../vendor/autoload.php');
require('./conexao/Conexao.php');
/* classes */
require('./util/autoload.php');

require('./util/util.php');
require('../app/authentication/Auth.php');
$app = new \Slim\App();


$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hello world !");
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
