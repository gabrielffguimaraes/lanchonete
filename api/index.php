<?php

require('../vendor/autoload.php');
require('./conexao/Conexao.php');
require('../app/authentication/Auth.php');
$app = new \Slim\App();
use Slim\Http\Request;
use Slim\Http\Response;




$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hello world !");
});


$app->group('/user', function() use ($app) {
    include './rest/LoginRest.php';
});

$app->group('/category', function() use ($app) {
    include './rest/CategoryRest.php';
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
