<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/metrics', function (Request $request, Response $response, array $args) {
    $managementController = new ManagementController();
    return $managementController->managementMetrics($request,$response,$args);
});
