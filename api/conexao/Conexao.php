<?php

class Conexao
{
    private $host = "localhost";
    private $username  = "root";
    private $password  = "";
    private $dbname  = "projeto";

    protected $connection = null;
    private $connectionIsOpen = false;

    public function __constructor() {

    }
    public function	get_connectionIsOpen(){
        return $this->connectionIsOpen;
    }

    public function open(){
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname, "3306");
        if (!$this->connection) {
            die('Não foi possível conectar: ' . mysqli_error());
        }
        $this->connectionIsOpen = true;
        return $this->connection!=false;
    }

    public function close(){
        return mysqli_close($this->connection);
    }

    public function query($sql){
        $sql = trim($sql);
        $this->resultado = $this->connection->query($sql);
        return $this->resultado;
    }

    public function checkLogin($user){
        $sql="SELECT *
		  	    FROM usuario
		  	   WHERE name=? AND password=?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $user['name'], $user['password']);
        $stmt->execute();
        $this->resultado = $stmt->get_result();
        return $this->resultado;
    }

    public function muyltipla_query($sql){
        $sql = trim($sql);
        $this->resultado = $this->connection->multi_query ($sql);
        return $this->resultado;
    }

    protected function createLineArray($result){
        return mysqli_fetch_assoc($result);
    }

    protected function createTableArray($result){
        $rows=[];
        foreach($result as $r){
            $rows[]=$r;
        }
        return $rows;
    }

    protected function countRows(){
        return $this->resultado->fetch_row();
    }

    static function debugaVetor($vetor, $interrompe = false)
    {
        echo "<pre>";
        print_r($vetor);
        echo "</pre>";
        if($interrompe)
            die();
    }



}