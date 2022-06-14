<?php

class ClientController extends ClientDAO
{
    public function __construct()
    {
        $this->open();
    }

    public function getAddress($req,$res,$args = []) {
        $name = getAuthorizationCredentials($req);
        $address = $this->getAddressById($args['id']);
        if(!$address) {
            return $res->withJson("Endereço não encontrado", 404);
        }
        return $res->withJson($address, 200);
    }
    public function getAddresses($req,$res) {
        $name = getAuthorizationCredentials($req);
        $client = $this->getClientByName($name);
        if(!$client) {
            return $res->withJson("Cliente não encontrado", 404);
        }
        $addresses = $this->getAddressesByClientId($client['id']);
        return $res->withJson($addresses, 200);
    }
    public function addAddress($req,$res)
    {
        $args = $req->getParsedBody();
        $name = getAuthorizationCredentials($req);
        $client = $this->getClientByName($name);
        if(!$client) {
            return $res->withJson("Cliente não encontrado", 404);
        }
        $newAdress = array(
            "cep" => $args['cep'],
            "address" => $args['address'],
            "complement" => $args['complement'],
            "city" => $args['city'],
            "uf" => $args['uf'],
            "country" => $args['country'],
            "client_id" => $client['id']
        );

        $result = $this->saveAddress($newAdress);
        $msg = ($result == 1) ? "Endereço adicionado com sucesso" : "Erro ao adicionar endereço";
        $status = ($result == 1) ? 201 : 400;
        return $res->withJson($msg, $status);
    }

}
