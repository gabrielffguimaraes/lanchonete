<?php

class IngredientController extends IngredientDAO
{

    public function __construct()
    {

        $this->open();
    }

    public function list($req,$res)
    {
        $ingredients = $this->getIngredients();
        return $res->withJson($ingredients,200);
    }
    public function listById($req,$res,$args)
    {
        $id = $args['id'];
        $ingredient = $this->getIngredients($id);
        if(!empty($ingredient)) {
            return $res->withJson($ingredient,200);
        } else {
            return $res->withJson("Ingrediente não encontrada",404);
        }
    }

    public function add($req,$res)
    {
        $args = $req->getParsedBody();
        $newIngredient = array(
            "description" => $args['description']
        );
        $this->getIngredientByDescription($newIngredient);
        $msg = "";
        $status = null;

        if(empty($this->countRows())) {
            $result = $this->addIngredient($newIngredient);
            $msg = ($result == 1) ? "Ingrediente criada com sucesso" : "Erro ao criar ingrediente";
            $status = ($result == 1) ? 201 : 400;
        } else {
            $msg = "Ingrediente já existe";
            $status = 400;
        }
        return $res->withJson($msg, $status);
    }
    public function update($req,$res)
    {
        $args = $req->getParsedBody();
        $ingredient = array(
            "id" => $args['id'],
            "description" => $args['description']
        );
        $this->getIngredientByDescription($ingredient);
        $msg = "";
        $status = null;

        if(empty($this->countRows())) {
            $result = $this->updateIngredient($ingredient);
            $msg = ($result >= 0) ? "Ingrediente atualizada com sucesso" : "Erro ao atualizar ingrediente";
            $status = ($result >= 0) ? 200 : 400;
        } else {
            $msg = "Ingrediente já existe";
            $status = 400;
        }
        return $res->withJson($msg, $status);
    }
}
