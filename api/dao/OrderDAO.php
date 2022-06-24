<?php

class OrderDAO extends Conexao
{
    public function __constructor()
    {
        
    }
    public function getOrderCountByStatus($statusId,$dini = "",$dfim = "") {
        $filter = [];
        $params = [];
        $s = "";
        if ($dini != "") {
            $filter[] = "AND DATE_FORMAT(po.created_at,'%Y-%m-%d') >= ?";
            $params[] = $dini;
            $s.="s";
        }

        if ($dfim != "") {
            $filter[] = "AND DATE_FORMAT(po.created_at,'%Y-%m-%d') <= ?";
            $params[] = $dfim;
            $s.="s";
        }
        $filter = implode(" ",$filter);
        $sql = "SELECT  count(*) as qtd FROM payment_order po WHERE po.status = ? $filter";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s".$s, ...array_merge([$statusId],$params));
        $stmt->execute();
        $result = $this->createLineArray($stmt->get_result());
        return  $result['qtd'] ?? 0;
    }
    public function getOrders($id = "",$clientId = "",$status = "",$dini = "",$dfim = "",$month = "") {
        $filter = [];
        $params = [];
        $s = "";
        if ($id != "") {
            if(empty($filter))  $filter[] = "WHERE p.id = ?";
            elseif (!empty($filter))  $filter[] = "AND p.id = ?";
            $params[] = $id;
            $s.="s";
        }
        if ($clientId != "") {
            if(empty($filter)) { $filter[] = "WHERE p.client_id = ?"; }
            elseif (!empty($filter)) $filter[] = "AND p.client_id = ?";
            $params[] = $clientId;
            $s.="s";
        }
        if ($status != "") {
            if(empty($filter)) { $filter[] = "WHERE p.status = ?"; }
            elseif (!empty($filter)) $filter[] = "AND p.status = ?";
            $params[] = $status;
            $s.="s";
        }

        if ($dini != "") {
            if(empty($filter)) { $filter[] = "WHERE DATE_FORMAT(p.created_at,'%Y-%m-%d') >= ?"; }
            elseif (!empty($filter)) $filter[] = "AND DATE_FORMAT(p.created_at,'%Y-%m-%d') >= ?";
            $params[] = $dini;
            $s.="s";
        }

        if ($dfim != "") {
            if(empty($filter)) { $filter[] = "WHERE DATE_FORMAT(p.created_at,'%Y-%m-%d') <= ?"; }
            elseif (!empty($filter)) $filter[] = "AND DATE_FORMAT(p.created_at,'%Y-%m-%d') <= ?";
            $params[] = $dfim;
            $s.="s";
        }
        if ($month != "") {
            if(empty($filter)) { $filter[] = "WHERE DATE_FORMAT(p.created_at,'%Y-%m') = ?"; }
            elseif (!empty($filter)) $filter[] = "AND DATE_FORMAT(p.created_at,'%Y-%m') = ?";
            $params[] = $month;
            $s.="s";
        }
        $filter = implode(" ",$filter);

        $sql = "SELECT p.*,c.complete_name,s.last,
                    s.description AS status_description,
                    @subtotal := (SELECT SUM(pop.price * pop.quantity) 
                        FROM payment_order_product pop 
                        WHERE pop.payment_order_id = p.id) as subtotal,
                    @subtotal  + p.delivery_fee as total,    
                    DATE_FORMAT((SELECT 
                            created_at 
                    FROM payment_order_status p1
                    WHERE p1.payment_order_id=p.id and p1.status = p.status LIMIT 1),'%d/%m/%Y ás %H:%i') as created_at_status,
                    DATE_FORMAT(p.created_at,'%d/%m/%Y ás %H:%i') as created_at
                FROM payment_order as p 
                INNER JOIN client c on p.client_id = c.id
                INNER JOIN status s on s.id = p.status
                $filter ORDER BY p.created_at";
        $stmt = $this->connection->prepare($sql);
        if($s != "") {
            $stmt->bind_param($s, ...$params);
        }
        $stmt->execute();
        $orders = $this->createTableArray($stmt->get_result());
        return  $orders;
    }
    public function getOrderProducts($orderId = "") {
        $sql = "SELECT po.*,
                    (SELECT group_concat(
                    (SELECT i.description FROM ingredient i WHERE i.id = pi.ingredient_id) separator ' , ') FROM product_ingredient pi WHERE pi.product_id = po.product_id) AS _ingredients,
                    p.description FROM 
                    payment_order_product po
                INNER JOIN product as p ON p.id = po.product_id
                WHERE payment_order_id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $orderProducts = $this->createTableArray($stmt->get_result());
        return  $orderProducts;
    }
    public function getStatusList($id = "") {
        $filter = [];
        $params = [];
        $s = "";
        if ($id != "") {
            if(empty($filter))  $filter[] = "WHERE p.id = ?";
            elseif (!empty($filter))  $filter[] = "AND p.id = ?";
            $params[] = $id;
            $s.="s";
        }
        $filter = implode(" ",$filter);
        $sql = "SELECT * FROM status $filter order by id";
        $stmt = $this->connection->prepare($sql);
        if($s != "") {
            $stmt->bind_param($s, ...$params);
        }
        $stmt->execute();
        $statuslist = $this->createTableArray($stmt->get_result());
        return  $statuslist;
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
    public function updateStatus($orderId,$status) {
        $sql="INSERT INTO payment_order_status 
                (id,payment_order_id,status) 
                    VALUES 
                (default,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss",
            $orderId,
            $status);
        $stmt->execute();
        return $stmt->affected_rows;
    }
    public function getStatusHistory($orderId = "") {
        $sql = "SELECT *,DATE_FORMAT(created_at,'%d/%m/%y ás %H:%i') as created_at FROM 
                    payment_order_status p
                INNER JOIN status s on s.id = p.status
                WHERE p.payment_order_id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $orderProducts = $this->createTableArray($stmt->get_result());
        return  $orderProducts;
    }
}
