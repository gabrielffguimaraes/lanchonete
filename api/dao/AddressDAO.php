<?php

class AddressDAO extends Conexao
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
    public function getAddressesByClientId($client_id): array
    {
        $sql = "SELECT * FROM address WHERE client_id=? and ativo=true";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $client_id);

        $stmt->execute();
        $addresses = $this->createTableArray($stmt->get_result());
        return $addresses;
    }
    public function update($address) {
        $sql="UPDATE address 
            SET name=?,cep=?,address=?,complement=?,city=?,uf=?,country=?,client_id=?
            WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssssssss",
            $address['name'],
            $address['cep'],
            $address['address'],
            $address['complement'],
            $address['city'],
            $address['uf'],
            $address['country'],
            $address['client_id'],
            $address['id']
        );
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function delete($id) {
        $sql="UPDATE address set ativo=false WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function save($address) {
        $sql="INSERT INTO address 
            (id,name,cep,address,complement,city,uf,country,client_id) 
                VALUES 
            (default,?,?,?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssssssss",
            $address['name'],
            $address['cep'],
            $address['address'],
            $address['complement'],
            $address['city'],
            $address['uf'],
            $address['country'],
            $address['client_id']
        );
        $stmt->execute();
        return  $stmt->affected_rows;
    }
}
