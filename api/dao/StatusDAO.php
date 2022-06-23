<?php

class StatusDAO extends Conexao
{
    public function __constructor($con = null)
    {
        $this->connection = $con;
        parent::__constructor();
    }

    public function getStatus($id = "") {

        $filter =  ($id != "") ? "where id=?" : "";
        $sql = "select * from status $filter";

        $stmt = $this->connection->prepare($sql);

        if($filter != "") {
            $stmt->bind_param("s", $id);
        }
        $stmt->execute();
        $status = $this->createTableArray($stmt->get_result());
        return  $status;
    }

}
