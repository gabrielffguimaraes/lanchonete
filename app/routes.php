<?php
session_name("sistema");
session_start();

require('../app/authentication/Auth.php');


require('../api/conexao/Conexao.php');
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$auth = Auth::authentication();

$app->post('/login', function (Request $request, Response $response, array $args) {
    $loginController = new LoginController();
    if($loginController->login($request->getParsedBody())) {
        return $response->withRedirect("/slim/public/about");
    } else {
        return $response->withRedirect("/slim/public/?isInvalid" );
    };
});

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'home.php');
});

$app->get('/about',function(Request $request, Response $response, array $args)
{
    $data = array(
        "credentials"=>Auth::credentials()
    );
    return $this->view->render($response, 'about.php',$data);
})->add($auth);
