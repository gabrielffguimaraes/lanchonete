<?php
error_reporting(E_ERROR | E_PARSE);
require('../api/conexao/Conexao.php');
require '../api/dao/LoginDAO.php';
require '../api/controller/LoginController.php';
use Slim\Http\Request;
use Slim\Http\Response;
$enviroments = require __DIR__. '/enviroments.php';
// Routes
$auth = Auth::authentication();

$app->post('/logout', function (Request $request, Response $response, array $args) use ($enviroments) {
    unset($_SESSION['name']);
    unset($_SESSION['password']);
    return $response->withRedirect("{$enviroments['baseUrl']}");
});
$app->post('/login', function (Request $request, Response $response, array $args) use ($enviroments) {
    $loginController = new LoginController();
    $params = $request->getParams();
    $path = "";
    if($loginController->login($request->getParsedBody())) {
        if($params['redirect']) {
            $path = $params['redirect'];
        }
        return $response->withRedirect("{$enviroments['baseUrl']}$path");
    } else {
        if($params['redirect']) {
            $path = "&redirect=".$params['redirect'];
        }
        return $response->withRedirect("{$enviroments['baseUrl']}login?invalid&message=Usuário ou senha incorretos$path" );
    };
});
$app->post('/register', function (Request $request, Response $response, array $args) use ($enviroments) {
    $loginController = new LoginController();
    $params = $request->getParams();
    $path = "";
    $ret = $loginController->registerUser($request,$response);

    if($ret['status'] == 201) {
        $body = $request->getParsedBody();
        $loginController->login(["username" => $body["username-register"],"password" => $body["password-register"]]);
        if($params['redirect']) {
            $path = $params['redirect'];
        }
        return $response->withRedirect("{$enviroments['baseUrl']}$path");
    } else {
        if($params['redirect']) {
            $path = "&redirect=".$params['redirect'];
        }
        return $response->withRedirect("{$enviroments['baseUrl']}login?invalid&message={$ret['message']}$path" );
    };
});

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'homepage.php');
});
$app->get('/product', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'products.php');
});
$app->get('/product/{id}/details', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'product-details.php',$args);
});
$app->get('/my-addresses', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'my-addresses.php');
});
$app->get('/my-addresses/{id}/edit', function (Request $request, Response $response, array $args) {
    $data = array(
        "id" => $args['id']
    );
    return $this->view->render($response, 'my-addresses.php',$data);
});
$app->get('/login', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'login.php');
});

$app->get('/payment', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'payment.php');
})->add(Auth::authentication("payment"));

$app->get('/cart', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'cart.php');
});

$app->get('/my-orders', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'my-orders.php');
})->add(Auth::authentication());

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
