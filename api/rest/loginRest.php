<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/register', function (Request $request, Response $response, array $args) {
    $LoginController = new LoginController();
    return $LoginController->registerUser($request,$response);
});