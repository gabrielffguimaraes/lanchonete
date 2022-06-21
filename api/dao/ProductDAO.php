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
    public function getMaxSizeProducts($filter,$params,$s) {
        $sql = "select count(id) as maxsize from product $filter";
        $stmt = $this->connection->prepare($sql);
        if($s != "") {
            $stmt->bind_param($s, ...$params);
        }
        $stmt->execute();
        $result =  $stmt->get_result();
        return $this->createLineArray($result)['maxsize'];
    }
    public function getProducts($id = "",$categories = "",$description="",$limit = 20,$offset = 0) {
        $categoryDAO = new CategoryDAO();
        $categoryDAO->connection = $this->connection;
        $filter = [];
        $params = [];
        $s = "";
        if ($id != "") {
            if (empty($filter)) $filter[] = "WHERE id = ?";
            elseif (!empty($filter)) $filter[] = "AND id = ?";
            $params[] = $id;
            $s .= "s";
        }
        if ($categories != "") {
            $arrTemp = explode(",",$categories);
            $arrSql = [];
            foreach ($arrTemp as $category_id) {
                $params[] = $category_id;
                $arrSql[] = " product.category = ? ";
                $s .= "s";
            }
            $sqlCategory = implode(" OR ",$arrSql);
            if (empty($filter)) $filter[] = "WHERE ($sqlCategory) = true";
            elseif (!empty($filter)) $filter[] = "AND ($sqlCategory) = true";
        }
        if ($description != "") {
            if (empty($filter)) $filter[] = "WHERE description like ?";
            elseif (!empty($filter)) $filter[] = "AND description like ?";
            $params[] = "%$description%";
            $s .= "s";
        }
        $filter = implode(" ",$filter);


        $sql = "SELECT *,
                (SELECT group_concat(
                    (SELECT i.description FROM ingredient i WHERE i.id = pi.ingredient_id) separator ' , ') FROM product_ingredient pi WHERE pi.product_id = p.id) AS _ingredients 
                from PRODUCT p 

         $filter  LIMIT ? OFFSET ?";
        $stmt = $this->connection->prepare($sql);

        $stmt->bind_param($s."ss", ...array_merge($params,[$limit,$offset]));
        $stmt->execute();
        $products = $this->createTableArray($stmt->get_result());

        foreach ($products as &$product) {
            $product['ingredient'] = $this->getIngredientProduct($product['id']);
            $product['category'] = $categoryDAO->getCategories($product['category']);
        }
        $response = array(
            "data" => $products,
            "maxsize" => $this->getMaxSizeProducts($filter,$params,$s)
        );
        return  $response;
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
        $sql = "SELECT * FROM product_ingredient WHERE ingredient_id=? and product_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $ingredientId , $productId);
        $stmt->execute();
        return  $stmt->get_result()->fetch_row();
    }
    public function saveProductPhoto($productId,$name) {
        $sql="INSERT INTO product_photo (product_id,name) VALUES (?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $productId , $name );
        $stmt->execute();
        return  $stmt->affected_rows;
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
