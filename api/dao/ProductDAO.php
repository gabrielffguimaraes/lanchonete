<?php

class ProductDAO extends Conexao
{
    public function __constructor()
    {

    }
    public function addProduct($product) {
        $sql="INSERT INTO product 
                (id,description,category,price,price_fake,detail,review) 
                    VALUES 
                (default,?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssssss",
            $product['description'],
            $product['category'],
            $product['price'],
            $product['price-fake'],
            $product['detail'],
            $product['review']);
        $stmt->execute();
        return  $stmt->insert_id;
    }
    public function editProduct($product) {
        $sql="UPDATE  product 
                SET description = ?,category = ?,price = ?,price_fake = ?,detail = ?,review = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssssss",$product['description'],$product['category'],$product['price'],$product['price-fake'],$product['detail'],$product['review'],$product['id']);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function getMaxSizeProducts($filter,$params,$s) {
        $sql = "select count(id) as maxsize from product p $filter";
        $stmt = $this->connection->prepare($sql);
        if($s != "") {
            $stmt->bind_param($s, ...$params);
        }
        $stmt->execute();
        $result =  $stmt->get_result();
        return $this->createLineArray($result)['maxsize'];
    }
    public function getProductsPhoto($productId,$type = "galery") {
        $filter = [];
        if($type == "main") {
            $filter[] = " ORDER BY id DESC ";
        }
        $filter = implode(" ",$filter);
        $sql = "SELECT * FROM product_photo WHERE product_id=? and type = ? $filter";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $productId,$type);
        $stmt->execute();
        $photos = $this->createTableArray($stmt->get_result());
        return  $photos;
    }
    public function getProducts($id = "",$categories = "",$description="" ,$limit = 20,$offset = 0 , $sit = null) {
        $categoryDAO = new CategoryDAO();
        $categoryDAO->connection = $this->connection;
        $filter = [];
        $params = [];
        $s = "";
        if ($sit != null && is_bool($sit)) {
            if (empty($filter)) $filter[] = "WHERE sit = ?";
            elseif (!empty($filter)) $filter[] = "AND sit = ?";
            $params[] = $sit;
            $s .= "s";
        }
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
                $arrSql[] = " p.category = ? ";
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
                from PRODUCT p $filter  LIMIT ? OFFSET ?";

        $stmt = $this->connection->prepare($sql);

        $stmt->bind_param($s."ss", ...array_merge($params,[$limit,$offset]));

        $stmt->execute();

        $products = $this->createTableArray($stmt->get_result());

        foreach ($products as &$product) {
            $product['ingredient'] = $this->getIngredientProduct($product['id']);
            $product['category'] = $categoryDAO->getCategories($product['category']);
            $product['galery'] = $this->getProductsPhoto($product['id'],"galery");
            $product['foto'] = $this->getProductsPhoto($product['id'],"main");
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
    public function deleteIngredientToProduct($productId,$ingredientId = "") {
        $filter = [];
        $s = "";
        $params = [];

        if ($ingredientId != "") {
            $filter[] = " AND ingredient_id = ? ";
            $params[] = $ingredientId;
            $s .= "s";
        }
        $filter = implode(" ",$filter);

        $sql="DELETE FROM product_ingredient WHERE product_id = ? $filter";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s".$s, ...array_merge([$productId] , $params));
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
    public function saveProductPhoto($productId,$name,$type = "galery") {
        $sql="INSERT INTO product_photo (product_id,name,type) VALUES (?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sss", $productId , $name ,$type);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function deleteProductPhoto($productId,$photoId) {
        $sql="DELETE FROM product_photo WHERE product_id = ? and id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $productId , $photoId);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function deleteProductMainPhoto($productId) {
        $sql="DELETE FROM product_photo WHERE product_id = ? and type='main'";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $productId );
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function deleteProduct($productId) {
        $sql="UPDATE product SET sit = false WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $productId );
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
