<?php

class LoginController extends LoginDAO
{

    public function __construct()
    {

        $this->open();
    }

    public function list()
    {
        return $this->getUsers();
    }
    public function login($args)
    {
        $user = array(
            "name" =>$args['username'],
            "password" =>$args['password']
        );
        $valid = $this->validate($user);
        if($valid) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['password'] = $user['password'];
        }
        return $valid;
    }
    public function registerUser($req,$res)
    {
        $args = $req->getParsedBody();
        $newUser = array(
            "name" => $args['username'],
            "password" => $args['password'],
            "email" => $args['email']
        );

        $this->findUserByNameOrEmail($newUser);

        if (!empty($this->countRows())) {
            return $res->withJson("Usuário ou email já existente(s)", 400);
        } else {
            $result = $this->register($newUser);
            $msg = ($result == 1) ? "Usuário adicionado com sucesso" : "Erro ao adicionar usuário";
            return $res->withJson($msg, 201);
        }
    }
}