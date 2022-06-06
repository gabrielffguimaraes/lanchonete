<?php

class ClientDAO extends Conexao
{
    public function __constructor($con = null)
    {
        $this->connection = $con;
        parent::__constructor();
    }
    public function getAddressById($id) {
        $sql = "SELECT * FROM address WHERE id=?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $id);

        $stmt->execute();
        $addresses = $this->createLineArray($stmt->get_result());
        return $addresses;
    }
    public function getAddressesByClientId($client_id) {
        $sql = "SELECT * FROM address WHERE client_id=?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $client_id);

        $stmt->execute();
        $addresses = $this->createTableArray($stmt->get_result());
        return $addresses;
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
    public function getClientByName($name = "") {
        $sql = "select * from client where name = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $name);

        $stmt->execute();
        $client = $this->createLineArray($stmt->get_result());
        return  $client;
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
