<?php
session_name("sistema");
session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require('vendor/autoload.php');

$settings = require __DIR__ . '/app/settings.php';
$enviroments = require __DIR__. '/app/enviroments.php';
$app = new \Slim\App($settings);

// Get container
$container = $app->getContainer();


// Register component on container
$container['view'] = function ($container) use ($enviroments){
    return new \Slim\Views\PhpRenderer('resources/views',$enviroments);
};


$container['notFoundHandler'] = function ($c) use ($enviroments){
    return function ($request, $response) use ($c,$enviroments) {
        return $response->withRedirect("{$enviroments['baseUrl']}404");
    };
};



// Register routes
require __DIR__ . '/app/routes.php';


$app->run();
