<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/register', function (Request $request, Response $response, array $args) {
    $LoginController = new LoginController();
    return $LoginController->registerUser($request,$response);
});
$app->post('/recover', function(Request $request, Response $response, array $args) use ($app) {
    $authController = new AuthController();
    return $authController->sendRecoveryCode($request,$response);
});