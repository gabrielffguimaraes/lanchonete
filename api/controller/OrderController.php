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

        /*VERIFICA CLIENTE*/
        $client = $clientDao->getClientByName($name);
        if (!$client) {
            return $res->withJson("Cliente não encontrado .", 404);
        }
        /*VERIFICA ENDEREÇO*/
        $address = $clientDao->getAddressById($args['address_id']);
        if (empty($address)) {
            return $res->withJson("Endereço não encontrado .", 404);
        }

        /*CALCULANDO FRETE*/
        try {
            $correio = new Correios();
            $frete = $correio->frete("21832006", $address['cep']);
        } catch (Exception $e) {
            return $res->withJson($e->getMessage(), 400);
        }

        $order = array(
            "client_id" => $client['id'],
            "address_id" => $args['address_id'],
            "discount" => 0,
            "delivery_fee" => $frete['valor'],
            "status" => 0
        );

        $stmt = $this->createOrder($order);
        if ($stmt->affected_rows != 1) {
            return $res->withJson("Erro , ocorreu um erro por favor tente mais tarde", 400);
        }
        $orderId = $stmt->insert_id;
        $this->updateStatus($orderId,0);
        // INSERTING PRODUCTS FROM CART
        $productDao = new ProductDao();
        $productDao->connection = $this->connection;
        foreach ($args['cart'] as $cartProduct) {
            $product = $productDao->getProducts($cartProduct['id'])[0];
            $orderProduct = array(
                "product_id" => $product['id'],
                "quantity" => $cartProduct['quantity'],
                "price" => $product['price']
            );
            $stmtOrderProduct = $this->addOrderProduct($orderId, $orderProduct);
            $orderProductId = $stmtOrderProduct->insert_id;

            foreach ($product['ingredient'] as $ingredient) {
                $stmtOrderProductIngredient = $this->addOrderProductIngredient($orderProductId, $ingredient['id']);
            }
        }

        return $res->withJson("Pedido realizado com sucesso", 201);

    }
    public function list($req,$res)
    {
        $clientDao = new ClientDao();
        $clientDao->connection = $this->connection;
        $name = getAuthorizationCredentials($req);

        /* verifica cliente */
        $client = $clientDao->getClientByName($name);
        if (!$client) {
            return $res->withJson("Cliente não encontrado .", 404);
        }
        $orders = $this->getOrders("",$client['id']);
        forEach($orders as &$order) {
            $order['products'] = $this->getOrderProducts($order['id']);
            $order['status_history'] = $this->getStatusHistory($order['id']);
            forEach($order['products'] as &$product) {
                $product['ingredients'] = $this->getOrderProductIngredients($product['id']);
            }
        }
        return $res->withJson($orders,200);
    }
    public function addStatus($req,$res,$args) {
        $order = $this->getOrders($args['order_id']);
        if(empty($order)) {
            return $res->withJson("Ordem do pedido não encontrado", 404);
        }
        $result = $this->updateStatus($args['order_id'],$args['status']);
        if($result != 1) {
            return $res->withJson("Erro ao mudar o status do pedido", 404);
        }

        $order[0]['status'] = $args['status'];
        $result = $this->updateOrder($order[0]);
        if($result == -1) {
            return $res->withJson("Erro ao mudar o status do pedido", 404);
        }

        return $res->withJson("Status atualizado com sucesso .", 200);
    }
    public function calcularFrete($req,$res,$args) {
        /*CALCULANDO FRETE*/
        try {
            $correio = new Correios();
            $frete = $correio->frete("21832006", $args['cep']);
            return $res->withJson($frete, 200);
        } catch (Exception $e) {
            return $res->withJson($e->getMessage(), 400);
        }
    }
}
