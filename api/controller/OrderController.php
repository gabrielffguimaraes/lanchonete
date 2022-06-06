<?php

class OrderController extends OrderDAO
{
    public function __construct()
    {

        $this->open();
    }
    public function create($req,$res)
    {
        $args = $req->getParsedBody();

        $clientDao = new ClientDao();
        $clientDao->connection = $this->connection;
        $name = getAuthorizationCredentials($req);
        $client = $clientDao->getClientByName($name);
        if (!$client) {
            return $res->withJson("Cliente não encontrado .", 404);
        }

        $address = $clientDao->getAddressById($args['address_id']);
        if (empty($address)) {
            return $res->withJson("Endereço não encontrado .", 404);
        }

        $order = array(
            "client_id" => $client['id'],
            "address_id" => $args['address_id'],
            "discount" => 0,
            "delivery_fee" => 0,
            "amount" => 0,
            "status" => 1,
        );

        $result = $this->createOrder($order);
        if($result != 1) {
            return $res->withJson("Erro , ocorreu um erro por favor tente mais tarde", 400);
        }
        return $res->withJson("Pedido realizado com sucesso", 201);
    }
}
