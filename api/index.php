<?php

require('../vendor/autoload.php');
require('./conexao/Conexao.php');
require('../app/authentication/Auth.php');
$app = new \Slim\App();


$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hello world !");
});


$app->group('/user', function() use ($app) {
    include './rest/loginRest.php';
});

$app->group('/category', function() use ($app) {
    include './rest/categoryRest.php';
});

$app->group('/ingredient', function() use ($app) {
    include './rest/ingredientRest.php';
});

$app->group('/client/products', function() use ($app) {
    include './rest/clientProductRest.php';
});
$app->group('/products', function() use ($app) {
    include './rest/product.php';
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
