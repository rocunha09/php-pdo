<?php

class DataBase extends PDO
{
    private $host = "localhost";
    private $port = 3307;
    private $db = "db_pdo";
    private $user = "root";
    private $password = "";
    private $conn;

    public function __construct(){
        try {
            $this->conn = new PDO("mysql:hostname=" . $this->host . "; port=" . $this->port . ";dbname=" . $this->db, $this->user, $this->password);
        
        } catch (PDOException $e) {
            $status = array(
                "status" => "Erro.",
                "Codigo" => $e->getCode(),
                "Mensagem" => $e->getMessage()
            );
            
            $this->conn = json_encode($status, true);
        }

        return $this->conn;

    }

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $val)
    {
        $this->$attr = $val;
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

    private function setParams($statement, $parameters = array()){

        foreach ($parameters as $key => $value) {
            $this->setParam($key, $value);

        }

    }

    private function setParam($statement, $key, $value){
        $statement->bindparam($key, $value);

    }

    public function query($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array()):array{
        $stmt = $this->query($rawQuery, $params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}

?>