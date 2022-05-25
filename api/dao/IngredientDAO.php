<?php

class IngredientDAO extends Conexao
{
    public function __constructor($con = null)
    {
        $this->connection = $con;
        parent::__constructor();
    }

    public function getIngredients($id = "") {

        $filter =  ($id != "") ? "where id=?" : "";
        $sql = "select * from ingredient $filter";

        $stmt = $this->connection->prepare($sql);

        if($filter != "") {
            $stmt->bind_param("s", $id);
        }
        $stmt->execute();
        $ingredients = $this->createTableArray($stmt->get_result());
        return  $ingredients;
    }
    public function addIngredient($ingredient) {
        $sql="INSERT INTO ingredient (id,description) VALUES (default,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $ingredient['description']);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function updateIngredient($ingredient) {
        $sql="UPDATE ingredient SET description=? WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $ingredient['description'],$ingredient['id']);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function getIngredientByDescription($ingredient) {
        $nParams = "s";
        $filter = "";
        $params = array();
        $params[] = $ingredient['description'];
        if(isset($ingredient['id']) and $ingredient['id'] != "") {
            $filter = " and id != ?";
            $nParams.="s";
            $params[] = $ingredient['id'];
        }

        $sql="SELECT * FROM ingredient WHERE description like ? $filter";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($nParams, ...$params);
        $stmt->execute();
        $this->resultado = $stmt->get_result();
        return  $this->resultado;
    }
}
