<?php
use Tuupola\Middleware\HttpBasicAuthentication;

class Auth
{
    public static function authentication() {
        return function ($request, $response, $next)  {
            if(isset($_SESSION['name']) && $_SESSION['name'] != "") {
                return $next($request, $response);
            } else {
                return $response->withRedirect("/slim/public/");
            }
        };
    }
    public static function basicAuth() : HttpBasicAuthentication
    {
        $loginController = new LoginController();
        $users = $loginController->list();
        return new HttpBasicAuthentication([
            "users" => $users,
            "error" => function ($response) {
                return  $response->withJson(array("response"=>"Unauthorized"), 403);
            }
        ]);
    }
    public static function credentials()
    {
        return "Basic ".base64_encode("{$_SESSION['name']}:{$_SESSION['password']}");
    }

}