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
    public function login($args,$role = "client")
    {
        $user = array(
            "name" =>$args['username'],
            "password" =>$args['password'],
            "role" =>$role
        );

        $valid = $this->validate($user);
        if($valid) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['password'] = $user['password'];
        }
        return $valid;
    }
    public function updateUserPass($name,$newPassword)
    {
        $resp = $this->updateUserPassword($name,$newPassword);
        return $resp;
    }
    public function registerUser($req,$res)
    {
        $args = $req->getParsedBody();
        $newUser = array(
            "complete-name" => $args['complete-name'],
            "name" => $args['username-register'],
            "password" => $args['password-register'],
            "email" => $args['email']
        );

        $this->findUserByNameOrEmail($newUser);

        $resp = [];
        if (!empty($this->countRows())) {
            $resp = array(
                "message" => "Usuário ou email já existente(s)",
                "status" => 400
            );
        } else {
            $result = $this->register($newUser);
            if ($result == 1) {
                $resp = array(
                    "message" => "Usuário adicionado com sucesso",
                    "status" => 201
                );
            } else {
                $resp = array(
                    "message" => "Erro ao adicionar usuário",
                    "status" => 400
                );
            }
        }
        return $resp;
    }
}
