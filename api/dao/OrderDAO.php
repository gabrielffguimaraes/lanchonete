<?php

class OrderDAO extends Conexao
{
    public function __constructor()
    {
        
    }
    public function createOrder($order) {
        $sql="INSERT INTO payment_order 
                (id,client_id,address_id,discount,delivery_fee,status) 
                    VALUES 
                (default,?,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssss",
            $order['client_id'],
            $order['address_id'],
            $order['discount'],
            $order['delivery_fee'],
            $order['status']);
        $stmt->execute();
        return $stmt;

    }
    public function addOrderProduct($orderId,$product) {
        $sql="INSERT INTO payment_order_product 
                (id,payment_order_id,product_id,quantity,price) 
                    VALUES 
                (default,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssss",
            $orderId,
            $product['product_id'],
            $product['quantity'],
            $product['price']);
        $stmt->execute();
        return $stmt;

    }
    public function addOrderProductIngredient($orderProductId,$ingredientId) {
        $sql="INSERT INTO payment_order_product_ingredient 
                (id,payment_order_product_id,ingredient_id) 
                    VALUES 
                (default,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss",
            $orderProductId,
            $ingredientId);
        $stmt->execute();
        return $stmt;
    }
}
