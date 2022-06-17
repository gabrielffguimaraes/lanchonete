<?php

class ClientController extends ClientDAO
{
    public function __construct()
    {
        $this->open();
    }
    public function getClientByRecoveryCode($req,$res,$args = []) {
        $params = $req->getParams();
        $token = $params["token"];
        $clientDAO = new ClientDao();
        $clientDAO->connection = $this->connection;
        $client = $clientDAO->getClientByRecoveryCodeDAO($token);
        if(!$client) {
            return false;
        }
        return $client;
    }
    public function getAddress($req,$res,$args = []) {
        $addressDAO = new AddressDAO();
        $addressDAO->connection = $this->connection;

        $name = Authmethods::getAuthorizationCredentials($req);
        $address = $addressDAO->getAddressById($args['id']);
        if(!$address) {
            return $res->withJson("Endereço não encontrado", 404);
        }
        return $res->withJson($address, 200);
    }
    public function getAddresses($req,$res) {
        $addressDAO = new AddressDAO();
        $addressDAO->connection = $this->connection;

        $name = Authmethods::getAuthorizationCredentials($req);
        $client = $this->getClientByName($name);
        if(!$client) {
            return $res->withJson("Cliente não encontrado", 404);
        }
        $addresses = $addressDAO->getAddressesByClientId($client['id']);
        return $res->withJson($addresses, 200);
    }
    public function addAddress($req,$res)
    {
        $addressDAO = new AddressDAO();
        $addressDAO->connection = $this->connection;

        $args = $req->getParsedBody();
        $name = Authmethods::getAuthorizationCredentials($req);
        $client = $this->getClientByName($name);
        if(!$client) {
            return $res->withJson("Cliente não encontrado", 404);
        }
        $newAdress = array(
            "name" => $args['name'],
            "cep" => $args['cep'],
            "address" => $args['address'],
            "complement" => $args['complement'],
            "city" => $args['city'],
            "uf" => $args['uf'],
            "country" => $args['country'],
            "client_id" => $client['id']
        );

        $result = $addressDAO->save($newAdress);
        $msg = ($result == 1) ? "Endereço adicionado com sucesso" : "Erro ao adicionar endereço";
        $status = ($result == 1) ? 201 : 400;
        return $res->withJson($msg, $status);
    }
    public function updateAddress($req,$res,$args)
    {
        $addressDAO = new AddressDAO();
        $addressDAO->connection = $this->connection;

        $args = array_merge($args,$req->getParsedBody());
        $name = Authmethods::getAuthorizationCredentials($req);
        $client = $this->getClientByName($name);
        if(!$client) {
            return $res->withJson("Cliente não encontrado", 404);
        }
        $address = $addressDAO->getAddressById($args['id']);
        if(!$address) {
            return $res->withJson("Endereço não encontrado", 404);
        }

        $address["name"] = $args['name'];
        $address["cep"] = $args['cep'];
        $address["address"] = $args['address'];
        $address["complement"] = $args['complement'];
        $address["city"] = $args['city'];
        $address["uf"] = $args['uf'];
        $address["country"] = $args['country'];

        $result = $addressDAO->update($address);
        $msg = ($result >= 0 ) ? "Endereço atualizado com sucesso" : "Erro ao atualizar endereço";
        $status = ($result >= 0 ) ? 200 : 400;
        return $res->withJson($msg, $status);
    }
    public function deleteAddress($req,$res,$args)
    {
        $addressDAO = new AddressDAO();
        $addressDAO->connection = $this->connection;

        $name = Authmethods::getAuthorizationCredentials($req);
        $client = $this->getClientByName($name);
        if(!$client) {
            return $res->withJson("Cliente não encontrado", 404);
        }
        $address = $addressDAO->getAddressById($args['id']);
        if(!$address) {
            return $res->withJson("Endereço não encontrado", 404);
        }

        $result = $addressDAO->delete($args['id']);
        $msg = ($result >= 0 ) ? "Endereço excluido com sucesso" : "Erro ao excluir endereço";
        $status = ($result >= 0 ) ? 200 : 400;
        return $res->withJson($msg, $status);
    }
}
