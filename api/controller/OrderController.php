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

        /* verifica cliente */
        $client = $clientDao->getClientByName($name);
        if (!$client) {
            return $res->withJson("Cliente não encontrado .", 404);
        }
        /* verifica endereço */
        $address = $clientDao->getAddressById($args['address_id']);
        if (empty($address)) {
            return $res->withJson("Endereço não encontrado .", 404);
        }

        $order = array(
            "client_id" => $client['id'],
            "address_id" => $args['address_id'],
            "discount" => 0,
            "delivery_fee" => 0,
            "status" => 1
        );

        $stmt = $this->createOrder($order);
        if ($stmt->affected_rows != 1) {
            return $res->withJson("Erro , ocorreu um erro por favor tente mais tarde", 400);
        }
        $orderId = $stmt->insert_id;

        // INSERTING PRODUCTS FROM CART
        $productDao = new ProductDao();
        $productDao->connection = $this->connection;
        foreach($args['cart'] as $cartProduct) {
            $product = $productDao->getProducts($cartProduct['id'])[0];
            $orderProduct = array(
                "product_id" => $product['id'],
                "quantity" => $cartProduct['quantity'],
                "price" => $product['price']
            );
            $stmtOrderProduct = $this->addOrderProduct($orderId,$orderProduct);
            $orderProductId = $stmtOrderProduct->insert_id;

            foreach ($product['ingredient'] as $ingredient) {
                $stmtOrderProductIngredient = $this->addOrderProductIngredient($orderProductId,$ingredient['id']);
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
        $orders = $this->getOrders($client['id']);
        forEach($orders as &$order) {
            $order['products'] = $this->getOrderProducts($order['id']);
            forEach($order['products'] as &$product) {
                $product['ingredients'] = $this->getOrderProductIngredients($product['id']);
            }
        }
        return $res->withJson($orders,200);
    }
}
