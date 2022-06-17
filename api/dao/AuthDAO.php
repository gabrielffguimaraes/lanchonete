<?php

class AuthDAO extends Conexao
{
    public function __constructor($con = null)
    {
        $this->connection = $con;
        parent::__constructor();
    }

    public function saveRecoveryCode($auth) {
        $sql="INSERT INTO auth_recover_pass 
                (client_id,recover_code,expiration_at) 
                VALUES 
                (?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sss", $auth['client_id'],$auth['recover_code'],$auth['expiration_at']);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function deleteRecoveryCode($auth) {
        $sql="DELETE FROM auth_recover_pass WHERE client_id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $auth['client_id']);
        $stmt->execute();
        return  $stmt->affected_rows;
    }
    public function getByRecoveryCode($token) {
        $sql = "SELECT * FROM auth_recover_pass WHERE recover_code = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $token);

        $stmt->execute();
        $recoverData = $this->createLineArray($stmt->get_result());
        return  $recoverData;
    }
}
