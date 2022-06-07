<?php
require('../api/conexao/Conexao.php');
use Slim\Http\Request;
use Slim\Http\Response;
$enviroments = require __DIR__. '/enviroments.php';
// Routes
$auth = Auth::authentication();

$app->post('/login', function (Request $request, Response $response, array $args) use ($enviroments) {
    $loginController = new LoginController();
    if($loginController->login($request->getParsedBody())) {
        return $response->withRedirect("{$enviroments['baseUrl']}about");
    } else {
        return $response->withRedirect("{$enviroments['baseUrl']}?isInvalid" );
    };
});

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'products.php');
});
$app->get('/payment', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'payment.php');
});
$app->get('/cart', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'cart.php');
});
$app->get('/client/order', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'orders.php');
});
$app->get('/product/{id}/ingredients', function (Request $request, Response $response, array $args) {
    $data = array(
        "productId" => $args['id']
    );
    return $this->view->render($response, 'choose-ingredients.php',$data);
});

/*
$app->get('/about',function(Request $request, Response $response, array $args)
{
    $data = array(
        "credentials"=>Auth::credentials()
    );
    return $this->view->render($response, 'about.php',$data);
})->add($auth);*/
