<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/register', 'LoginController:registerUser');
$app->post('/recover', 'AuthController:sendRecoveryCode');
