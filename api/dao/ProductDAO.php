<?php

class ProductDAO extends Conexao
{
    public function __constructor()
    {

    }
    public function addProduct($product) {
        $sql="INSERT INTO product 
                (id,description,category,price) 
                    VALUES 
                (default,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sss",$product['description'],$product['category'],$product['price']);
        $stmt->execute();
        return  $stmt->insert_id;
    }
    public function getProducts($id = "") {
        $categoryDAO = new CategoryDAO();
        $categoryDAO->connection = $this->connection;

        $filter =  ($id != "") ? "where id=?" : "";
        $sql = "select * from product $filter";
        $stmt = $this->connection->prepare($sql);
        if($filter != "") {
            $stmt->bind_param("s", $id);
        }
        $stmt->execute();
        $products = $this->createTableArray($stmt->get_result());

        foreach ($products as &$product) {
            $product['ingredient'] = $this->getIngredientProduct($product['id']);
            $product['category'] = $categoryDAO->getCategories($product['category']);
        }
        return  $products;
    }
    public function getIngredientProduct($productId) {
        $sql = "SELECT i.* FROM 
                    product_ingredient as pi
                INNER JOIN ingredient i on i.id = pi.ingredient_id
                WHERE product_id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $ingredients = $this->createTableArray($stmt->get_result());
        return  $ingredients;
    }
    public function addIngredientToProduct($productId,$ingredientId) {
        $sql="INSERT INTO product_ingredient (product_id,ingredient_id) VALUES (?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $productId , $ingredientId);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function existIngredientProduct($ingredientId,$productId) {
        $sql = "select * from product_ingredient where ingredient_id=? and product_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $ingredientId , $productId);
        $stmt->execute();
        return  $stmt->get_result()->fetch_row();
    }
    /*
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
   }*/
}
