<?php

class LoginDAO extends Conexao
{
    public function __constructor()
    {
        parent::__constructor(); // TODO: Change the autogenerated stub
    }

    public function getUsers() {
        $sql = "select * from user";
        $response = [];
        $users = $this->createTableArray($this->query($sql));
        forEach($users as $user) {
            $response[$user['name']] = $user['password'];
        }
        return $response;
    }
    public function register($user) {
        $sql="INSERT INTO user (id,name,password,email) VALUES (default,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sss", $user['name'], $user['password'] , $user['email'] );
        $stmt->execute();

        return  $stmt->affected_rows;
    }
    public function findUserByNameOrEmail($user) {
        $sql="SELECT * FROM user WHERE name=? or email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $user['name'] , $user['email'] );
        $stmt->execute();
        $this->resultado = $stmt->get_result();
        return $this->resultado;
    }
    public function validate($user) {
        $this->checkLogin($user);
        return !empty($this->countRows());
    }
}