<?php
date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ERROR | E_PARSE);

use Slim\Http\Request;
use Slim\Http\Response;
$enviroments = require __DIR__. '/enviroments.php';

$app->post('/logout', function (Request $request, Response $response, array $args) use ($enviroments) {
    unset($_SESSION['name']);
    unset($_SESSION['password']);
    $params = $request->getParams();
    if(isset($params['redirect'])) {
        return $response->withRedirect("{$enviroments['baseUrl']}{$params['redirect']}");
    } else {
        return $response->withRedirect("{$enviroments['baseUrl']}login");
    }
});
$app->post('/login', function (Request $request, Response $response, array $args) use ($enviroments) {
    $loginController = new LoginController();
    $params = $request->getParams();
    $path = "";
    if($loginController->login($request->getParsedBody(),"client")) {
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

$app->post('/management/login', function (Request $request, Response $response, array $args) use ($enviroments) {
    $loginController = new LoginController();
    if($loginController->login($request->getParsedBody(),"employee")) {
        return $response->withRedirect("{$enviroments['baseUrl']}management/dashboard");
    } else {
        return $response->withRedirect("{$enviroments['baseUrl']}management/login?invalid&message=Usuário ou senha incorretos" );
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
$app->post('/recover', function (Request $request, Response $response, array $args) use ($enviroments) {
    $params = $request->getParams();
    $authController = new AuthController();
    $clientController = new ClientController($request,$response,$args);
    try {
        $authController->verifyRecoveryCode($params['token']);
        $client = $clientController->getClientByRecoveryCode($request,$response,$args);
        if(!$client) {
            throw new Exception("Cliente não encontrado em nossa base de dados .");
        }
        $loginController = new LoginController();
        $result = $loginController->updateUserPass($client["name"],$params["password"]);
        if($result < 0) {
            throw new Exception("Error ao atualizar senha");
        }
        $authController->deleteRecoveryCode($client);
        $msg = "Senha de acesso recuperada realize o login .";
        return $response->withRedirect("{$enviroments['baseUrl']}login?valid&message=$msg" );
    } catch(Exception $e) {
        return $response->withRedirect("{$enviroments['baseUrl']}login?invalid&message={$e->getMessage()}" );
    }
});

// CLIENT ROUTES
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
$app->get('/recover', function (Request $request, Response $response, array $args) {
    $clientController = new ClientController();
    $client = $clientController->getClientByRecoveryCode($request,$response,$args);
    $data = array(
        "name" => $client["name"]
    );
    return $this->view->render($response, 'recover.php',$data);
})->add(Authmethods::isValidRecoveryCode());

$app->get('/forgot', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'forgot.php');
});

$app->get('/payment', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'payment.php');
})->add(Auth::authenticationClientLogged($enviroments,"payment"));

$app->get('/my-orders', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'my-orders.php');
})->add(Auth::authenticationClientLogged($enviroments));

$app->get('/cart', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'cart.php');
});


$app->get('/product/{id}/ingredients', function (Request $request, Response $response, array $args) {
    $data = array(
        "productId" => $args['id']
    );
    return $this->view->render($response, 'choose-ingredients.php',$data);
});

// MANAGER ROUTES
$app->group('/management',function () use ($app) {
    $app->get('/login', function (Request $request, Response $response, array $args) {
        return $this->view->render($response, 'management/login.php');
    });
    $app->get('/dashboard', function (Request $request, Response $response, array $args) {
        return $this->view->render($response, 'management/dashboard.php');
    });
    $app->get('/products', function (Request $request, Response $response, array $args) {
        return $this->view->render($response, 'management/products/products.php');
    });
    $app->get('/products/add', function (Request $request, Response $response, array $args) {
        return $this->view->render($response, 'management/products/product-form.php');
    });
    $app->get('/products/{id}/edit', function (Request $request, Response $response, array $args) {
        $productController = new ProductController();
        $product = $productController->listById($request,$response,$args,false);
        $data = array(
            "edit" => true,
            "product" => $product
        );
        return $this->view->render($response, 'management/products/product-form.php',$data);
    });
})->add(Auth::authenticationManagerLogged($enviroments));
