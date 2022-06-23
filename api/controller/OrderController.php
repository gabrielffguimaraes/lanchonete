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

        $addressDao = new AddressDao();
        $addressDao->connection = $this->connection;

        $name = Authmethods::getAuthorizationCredentials($req);

        /*VERIFICA CLIENTE*/
        $client = $clientDao->getClientByName($name);
        if (!$client) {
            return $res->withJson("Cliente não encontrado .", 404);
        }

        /*VERIFICA ENDEREÇO*/
        $address = $addressDao->getAddressById($args['address_id']);

        if (!$address) {
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
            "status" => 1
        );

        $stmt = $this->createOrder($order);
        if ($stmt->affected_rows != 1) {
            return $res->withJson("Erro , ocorreu um erro por favor tente mais tarde", 400);
        }
        $orderId = $stmt->insert_id;
        $this->updateStatus($orderId,1);

        // INSERTING PRODUCTS FROM CART
        $productDao = new ProductDao();
        $productDao->connection = $this->connection;
        foreach ($args['cart'] as $cartProduct) {
            $products = $productDao->getProducts($cartProduct['id'])["data"];
            if(!empty($products)) {
                $product = $products[0];
                $orderProduct = array(
                    "product_id" => $product['id'],
                    "quantity" => $cartProduct['quantity'],
                    "price" => $product['price']
                );
                $stmtOrderProduct = $this->addOrderProduct($orderId, $orderProduct);
                $orderProductId = $stmtOrderProduct->insert_id;

                foreach ($cartProduct['ingredient'] as $ingredient_id) {
                    $stmtOrderProductIngredient = $this->addOrderProductIngredient($orderProductId, $ingredient_id);
                }
            }
        }

        return $res->withJson("Pedido realizado com sucesso", 201);

    }
    public function listStatus($req,$res,$args)
    {
        $statusDao = new StatusDao();
        $statusDao->connection = $this->connection;

        $statusList = $statusDao->getStatus();
        foreach($statusList as &$status) {
            $status['qtd'] = $this->getOrderCountByStatus($status["id"]);
        }
        return $res->withJson($statusList,200);
    }
    public function list($req,$res,$manager = false)
    {
        $clientDao = new ClientDao();
        $clientDao->connection = $this->connection;

        $productDao = new ProductDao();
        $productDao->connection = $this->connection;

        $addressDao = new AddressDao();
        $addressDao->connection = $this->connection;

        $name = Authmethods::getAuthorizationCredentials($req);

        /* verifica cliente */
        $client = $clientDao->getClientByName($name);
        if (!$client) {
            return $res->withJson("Cliente não encontrado .", 404);
        }
        $orders = $this->getOrders("",$client['id']);
        forEach($orders as &$order) {
            $order['products'] = $this->getOrderProducts($order['id']);
            $order['status_history'] = $this->getStatusHistory($order['id']);
            $order['address'] = $addressDao->getAddressById($order['address_id']);
            forEach($order['products'] as &$order_product) {
                $order_product['ingredients'] = $this->getOrderProductIngredients($order_product['id']);
                $order_product['foto'] = $productDao->getProductsPhoto($order_product['product_id'],"main");
            }
        }
        return $res->withJson($orders,200);
    }
    public function listAll($req,$res)
    {
        $clientDao = new ClientDao();
        $clientDao->connection = $this->connection;

        $productDao = new ProductDao();
        $productDao->connection = $this->connection;

        $addressDao = new AddressDao();
        $addressDao->connection = $this->connection;

        $params = $req->getParams();
        $params["order_id"] = isset($params["order_id"]) ? $params["order_id"] : "";
        $params["status"] = isset($params["status"]) ? $params["status"] : "";

        $orders = $this->getOrders($params["order_id"],"",$params["status"]);
        forEach($orders as &$order) {
            $order['products'] = $this->getOrderProducts($order['id']);
            $order['status_history'] = $this->getStatusHistory($order['id']);
            $order['address'] = $addressDao->getAddressById($order['address_id']);
            forEach($order['products'] as &$order_product) {
                $order_product['ingredients'] = $this->getOrderProductIngredients($order_product['id']);
                $order_product['foto'] = $productDao->getProductsPhoto($order_product['product_id'],"main");
            }
        }
        return $res->withJson($orders,200);
    }
    public function addStatus($req,$res,$args) {
        $order = $this->getOrders($args['order_id']);
        if(empty($order)) {
            return $res->withJson("Ordem do pedido não encontrado", 404);
        }
        if($order[0]['last']) {
            return $res->withJson("Pedido já foi finalizado .", 400);
        }
        $statusNext = $order[0]['status'] + 1;
        $result = $this->updateStatus($args['order_id'],$statusNext);
        if($result != 1) {
            return $res->withJson("Erro ao mudar o status do pedido", 404);
        }

        $order[0]['status'] =$statusNext;
        $result = $this->updateOrder($order[0]);
        if($result < 0) {
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
