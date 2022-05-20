<?php

class CategoryController extends CategoryDAO
{

    public function __construct()
    {

        $this->open();
    }

    public function list($req,$res)
    {
        $categories = $this->getCategories();
        return $res->withJson($categories,200);
    }
    public function listById($req,$res,$args)
    {
        $id = $args['id'];
        $category = $this->getCategories($id);
        if(!empty($category)) {
            return $res->withJson($category,200);
        } else {
            return $res->withJson("Categoria não encontrada",404);
        }
    }
   /*
    public function add($req,$res)
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
    }*/
}