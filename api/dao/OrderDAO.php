<?php

class OrderDAO extends Conexao
{
    public function __constructor()
    {
        
    }
    public function createOrder($order) {
        $sql="INSERT INTO payment_order 
                (id,client_id,address_id,discount,delivery_fee,amount,status) 
                    VALUES 
                (default,?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssssss",
            $order['client_id'],
            $order['address_id'],
            $order['discount'],
            $order['delivery_fee'],
            $order['amount'],
            $order['status']);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
}
