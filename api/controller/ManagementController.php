<?php

class ManagementController extends Conexao
{
    private $clientDAO;
    private $orderDAO;
    public function __construct()
    {
        $this->open();
        $this->clientDAO = new ClientDAO();
        $this->clientDAO->connection = $this->connection;
        $this->orderDAO = new OrderDAO();
        $this->orderDAO->connection = $this->connection;
    }

    private function growth($v1,$v2) {
        if($v1 == 0) {
            $growth = 0;
        } elseif($v2 != 0) {
            $growth = ($v1 / $v2) - 1;
            $growth = ($growth < 0) ? 0 : ($growth * 100);
        } else {
            $growth = 100;
        }
        return  $growth;
    }
    public function managementMetrics($req,$res,$args)
    {
        $params = $req->getParams();

        $last = new DateTime("{$params['date']} first day of last month");
        $last = $last->format('Y-m');

        $current = new DateTime($params['date']);
        $current = $current->format('Y-m');

        $current_clients = $this->clientDAO->getClients($current);
        $last_clients = $this->clientDAO->getClients($last);

        $current_orders = $this->orderDAO->getOrders("","",5,"","",$current);
        $last_orders = $this->orderDAO->getOrders("","",5,"","",$last);

        $current_revenue = array_sum(array_map(function ($current_orders) {return $current_orders["total"];},$current_orders));
        $last_revenue = array_sum(array_map(function ($last_orders) {return $last_orders["total"];},$last_orders));


        $metrics = [];
        $metrics["clients"] = count($current_clients);
        $metrics["clients_growth"] = number_format($this->growth(count($current_clients),count($last_clients)),2);

        $metrics["orders"] = count($current_orders);
        $metrics["orders_growth"] = number_format($this->growth(count($current_orders),count($last_orders)),2);

        $metrics["revenue"] = $current_revenue;
        $metrics["revenue_growth"] = number_format($this->growth($current_revenue,$last_revenue),2);
        return $res->withJson($metrics,200);
    }
}
