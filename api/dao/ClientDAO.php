<?php

class ClientDAO extends Conexao
{
    public function __constructor($con = null)
    {
        $this->connection = $con;
        parent::__constructor();
    }

    public function getClientByName($name = "") {
        $sql = "SELECT * FROM client WHERE name = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $name);

        $stmt->execute();
        $client = $this->createLineArray($stmt->get_result());
        return  $client;
    }
    public function getClientByEmail($email = "",$role = "client") {
        $sql = "SELECT * FROM client WHERE email = ? and role = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $email,$role);

        $stmt->execute();
        $client = $this->createLineArray($stmt->get_result());
        return  $client;
    }
    public function getClientByRecoveryCodeDAO($token = "") {
        $sql = "SELECT * FROM client 
                INNER JOIN auth_recover_pass auth on auth.client_id = client.id
                WHERE auth.recover_code = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $token);

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
