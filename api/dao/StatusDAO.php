<?php

class StatusDAO extends Conexao
{
    public function __constructor($con = null)
    {
        $this->connection = $con;
        parent::__constructor();
    }

    public function getStatus($id = "",$cancelado = true) {

        $filter = [];
        $params = [];
        $s = "";
        if ($id != "") {
            if (empty($filter)) $filter[] = "WHERE id = ?";
            elseif (!empty($filter)) $filter[] = "AND id = ?";
            $params[] = $id;
            $s .= "s";
        }
        if (!$cancelado) {
            if (empty($filter)) $filter[] = "WHERE id != ?";
            elseif (!empty($filter)) $filter[] = "AND id != ?";
            $params[] = $cancelado;
            $s .= "s";
        }
        $filter = implode(" ",$filter);
        $sql = "select * from status $filter";

        $stmt = $this->connection->prepare($sql);

        if($s != "") {
            $stmt->bind_param($s, ...$params);
        }
        $stmt->execute();
        $status = $this->createTableArray($stmt->get_result());
        return  $status;
    }

}
