<?php

class ClientController extends ClientDAO
{
    public function __construct()
    {
        $this->open();
    }

    public function getAddresses($req,$res) {
        $params = $req->getServerParams();
        $authorization = base64_decode(explode(" ",$params['HTTP_AUTHORIZATION'])[1]);
        $name = explode(":",$authorization)[0];
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
        $newAdress = array(
            "number" => $args['number'],
            "street" => $args['street'],
            "district" => $args['district'],
            "city" => $args['city'],
            "uf" => $args['uf'],
            "ref" => $args['ref'],
            "client_id" => $args['client_id']
        );
        $client = $this->getClients($args['client_id']);
        if (empty($client)) {
            return $res->withJson("Cliente não encontrado", 404);
        }

        $result = $this->saveAddress($newAdress);
        $msg = ($result == 1) ? "Endereço adicionado com sucesso" : "Erro ao adicionar endereço";
        $status = ($result == 1) ? 201 : 400;
        return $res->withJson($msg, $status);
    }

}
