<?php

class ClientDAO extends Conexao
{
    public function __constructor($con = null)
    {
        $this->connection = $con;
        parent::__constructor();
    }

    public function getClientByName($name = "") {
        $sql = "select * from client where name = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $name);

        $stmt->execute();
        $client = $this->createLineArray($stmt->get_result());
        return  $client;
    }
    public function getClientByEmail($email = "") {
        $sql = "select * from client where email = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $email);

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
