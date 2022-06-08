<?php

class OrderDAO extends Conexao
{
    public function __constructor()
    {
        
    }
    public function getOrders($clientId = "") {
        $sql = "SELECT *,
                CASE 
                    WHEN p.status = 1 THEN 'Pedido recebido'
                    WHEN p.status = 2 THEN 'Pagamento aprovado'
                    WHEN p.status = 3 THEN 'Preparando Pedido'
                    WHEN p.status = 4 THEN 'Em transporte'
                    WHEN p.status = 5 THEN 'Pedido entregue'
                    ELSE '' 
                END AS status_description,
                DATE_FORMAT((SELECT 
                        created_at 
                FROM payment_order_status p1
                WHERE p1.payment_order_id=p.id and p1.status = p.status LIMIT 1),'%d/%m/%Y ás %H:%i') as created_at
                FROM payment_order as p WHERE client_id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $clientId);
        $stmt->execute();
        $orders = $this->createTableArray($stmt->get_result());
        return  $orders;
    }
    public function getOrderProducts($orderId = "") {
        $sql = "SELECT po.*,p.description FROM 
                    payment_order_product po
                INNER JOIN product as p ON p.id = po.product_id
                WHERE payment_order_id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $orderProducts = $this->createTableArray($stmt->get_result());
        return  $orderProducts;
    }
    public function getOrderProductIngredients($orderProductId = "") {
        $sql = "SELECT pi.*,i.description FROM 
                    payment_order_product_ingredient pi
                INNER JOIN ingredient as i ON i.id = pi.ingredient_id
                WHERE payment_order_product_id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $orderProductId);
        $stmt->execute();
        $orderProductIngredients = $this->createTableArray($stmt->get_result());
        return  $orderProductIngredients;
    }
    public function updateOrder($order) {
        $sql="UPDATE  payment_order SET 
                 client_id = ?,address_id = ?,discount = ?,delivery_fee = ?,status = ? 
              WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssssss",
            $order['client_id'],
            $order['address_id'],
            $order['discount'],
            $order['delivery_fee'],
            $order['status'],
            $order['id']);
        $stmt->execute();
        return $stmt->affected_rows;
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
    public function updateStatus($order_id,$status) {
        $sql="INSERT INTO payment_order_status 
                (id,payment_order_id,status) 
                    VALUES 
                (default,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss",
            $order_id,
            $status);
        $stmt->execute();
        return $stmt->affected_rows;
    }
    public function getStatusHistory($orderId = "") {
        $sql = "SELECT *,DATE_FORMAT(created_at,'%d/%m/%y ás %H:%i') as created_at FROM 
                    payment_order_status p
                WHERE p.payment_order_id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $orderProducts = $this->createTableArray($stmt->get_result());
        return  $orderProducts;
    }
}
