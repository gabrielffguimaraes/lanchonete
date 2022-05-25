<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require('../vendor/autoload.php');

$settings = require __DIR__ . '/../app/settings.php';

$app = new \Slim\App($settings);


// Get container
$container = $app->getContainer();


// Register component on container
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('../resources/views',['baseUrl' => '/lanchonete/public/']);
};


$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['view']->render($response->withStatus(404), '404.php', [
            "myError" => "Error"
        ]);
    };
};



// Register routes
require __DIR__ . '/../app/routes.php';


$app->run();
