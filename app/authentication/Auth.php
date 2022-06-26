<?php
use Tuupola\Middleware\HttpBasicAuthentication;

class Auth
{
    public static function loggedUser() {
        $clientController = new ClientController();
        if(isset($_SESSION['name'])) {
            return $clientController->getClientByName($_SESSION['name']);
        }
        return false;
    }
    public static function authenticationClientLogged($enviroments,$redirect = "") {
        $urlRedirect = "";
        if ($redirect != "") {
            $urlRedirect = "?redirect=$redirect";
        }
        return function ($request, $response, $next) use ($urlRedirect,$enviroments) {
            $userLogged = $enviroments["userLogged"];
            if($userLogged && $userLogged["role"] == "client") {
                return $next($request, $response);
            } else {
                return $response->withRedirect("{$enviroments['baseUrl']}login$urlRedirect");
            }
        };
    }
    public static function authenticationManagerLogged($enviroments) {
        return function($request,$response,$next) use ($enviroments) {
            $path = $request->getUri()->getPath();

            $userLogged = $enviroments["userLogged"];

            // BLOQUEIO DE ACESSO AO SISTEMA PARA USUARIO N LOGADO
            if(!str_contains($path,"login")) {
                if(!$userLogged) {
                    return $response->withRedirect("{$enviroments['baseUrl']}management/login");
                }
                if($userLogged && $userLogged["role"] != "employee") {
                    return $response->withRedirect("{$enviroments['baseUrl']}management/login");
                }
            } else {
                if($userLogged && $userLogged["role"] == "employee") {
                    return $response->withRedirect("{$enviroments['baseUrl']}management/dashboard");
                }
            }

            return $next($request,$response);
        };
    }
    public static function credentials()
    {
        if(isset($_SESSION['name']) && isset($_SESSION['password'])) {
           return "Basic " . base64_encode("{$_SESSION['name']}:{$_SESSION['password']}");
        } else {
            return "";
        }
    }

}
