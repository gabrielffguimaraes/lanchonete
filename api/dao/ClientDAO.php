<?php

class ClientDAO extends Conexao
{
    public function __constructor($con = null)
    {
        $this->connection = $con;
        parent::__constructor();
    }
    public function saveAddress($address) {
        $sql="INSERT INTO address 
            (id,number,street,district,city,uf,ref,client_id) 
                VALUES 
            (default,?,?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssssss",
            $address['number'],
            $address['street'],
            $address['district'],
            $address['city'],
            $address['uf'],
            $address['ref'],
            $address['client_id'],
        );
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function getClients($id = "") {
        $filter =  ($id != "") ? "where id=?" : "";
        $sql = "select * from client $filter";

        $stmt = $this->connection->prepare($sql);

        if($filter != "") {
            $stmt->bind_param("s", $id);
        }
        $stmt->execute();
        $clients = $this->createTableArray($stmt->get_result());
        return  $clients;
    }
}