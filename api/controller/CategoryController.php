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

    public function add($req,$res)
    {
        $args = $req->getParsedBody();
        $newCategory = array(
            "description" => $args['description']
        );
        $this->getCategoryByDescription($newCategory);
        $msg = "";
        $status = null;

        if(empty($this->countRows())) {
            $result = $this->addCategory($newCategory);
            $msg = ($result == 1) ? "Categoria criada com sucesso" : "Erro ao criar categoria";
            $status = ($result == 1) ? 201 : 400;
        } else {
            $msg = "Categoria já existe";
            $status = 400;
        }
        return $res->withJson($msg, $status);
    }
    public function update($req,$res)
    {
        $args = $req->getParsedBody();
        $category = array(
            "id" => $args['id'],
            "description" => $args['description']
        );
        $this->getCategoryByDescription($category);
        $msg = "";
        $status = null;

        if(empty($this->countRows())) {
            $result = $this->updateCategory($category);
            $msg = ($result >= 0) ? "Categoria atualizada com sucesso" : "Erro ao atualizar categoria";
            $status = ($result >= 0) ? 200 : 400;
        } else {
            $msg = "Categoria já existe";
            $status = 400;
        }
        return $res->withJson($msg, $status);
    }
}
