<?php

class DataBase 
{
    private $host;
    private $port;
    private $db;
    private $user;
    private $password;
    private $conn;


    public function __construct($host, $port, $db, $user, $password){
        $this->host = $host;
        $this->port = $port;
        $this->db = $db;
        $this->user = $user;
        $this->password = $password;
        $this->conectar();

        return $this;
    }

    public function getDb(){
        return $this->conn;
    }

    private function conectar(){
        try {
            $conexao = new PDO("mysql:hostname=" . $this->host . "; port=" . $this->port . ";dbname=" . $this->db, $this->user, $this->password);
            $this->conn = $conexao;
            
            $status = array(
                'status' => "Conectado com Sucesso."
            );
            $result = json_encode($status, true);

        } catch (PDOException $e) {
            $status = array(
                "status" => "Erro.",
                "Codigo" => $e->getCode(),
                "Mensagem" => $e->getMessage()
            );
            $result = json_encode($status, true);
        }

        return $result;
    }

     //criar tabela
    public function create($entidade, $campos = array()){
        $camposLength = count($campos);
        
        $sql="CREATE TABLE IF NOT EXISTS $entidade(";
        for($i = 0; $i < $camposLength; $i++){
            $sql .= $campos[$i] . ", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ");";

        $result =  $this->conn->exec($sql);
        return $result;

    }
}

?>