<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/metrics', 'ManagementController:managementMetrics');
