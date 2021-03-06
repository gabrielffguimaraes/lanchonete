<?php

use Tuupola\Middleware\HttpBasicAuthentication;

Class Authmethods
{
    public static function getAuthorizationCredentials($req)
    {
        $params = $req->getServerParams();
        $authorization = base64_decode(explode(" ", $params['HTTP_AUTHORIZATION'])[1]);
        return explode(":", $authorization)[0];
    }
    public static function isValidRecoveryCode() {
        return function ($request, $response, $next) {
            $params = $request->getParams();
            $enviroments = require __DIR__. './../../app/enviroments.php';

            if (!isset($params['token'])){
                return $response->withRedirect("{$enviroments['baseUrl']}login");
            }
            $authController = new AuthController();
            try {
                $authController->verifyRecoveryCode($params['token']);
                return $next($request, $response);
            } catch(Exception $e) {
                return $response->withRedirect("{$enviroments['baseUrl']}login?invalid&message={$e->getMessage()}");
            }
        };
    }
    public static function basicAuth($roles) : HttpBasicAuthentication
    {
        $loginController = new LoginController();
        $users = $loginController->list($roles);
        return new HttpBasicAuthentication([
            "users" => $users,
            "error" => function ($response) {
                return  $response->withJson(array("response"=>"Unauthorized"), 403);
            }
        ]);
    }
}
