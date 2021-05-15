<?php
require_once "Models/DataBase.php";

class Usuario
{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $db;


    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $val)
    {
        $this->$attr = $val;
    }

    public function inserir()
    {
        $sql="insert into tb_users( nome, email, senha) values (:nome, :email, :senha)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":nome", $this->__get("nome"));
        $stmt->bindValue(":email", $this->__get("email"));
        $stmt->bindValue(":senha", $this->__get("senha"));
        $result = $stmt->execute();

        if($result){
            $status = array(
                'status' => 1,
                'message' => "Dados salvos com sucesso."
            );
            $result = json_encode($status, true);

        } else {
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro ao salvar dados."
            );
            $result = json_encode($status, true);

        }
        return $result;
    }

    public function atualizar()
    {
        $sql="select count(*) as status from tb_users where id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $this->__get("id"));
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        if($result['status'] == 0){
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro ao atualizar dados.",
                'stmt errorinfo' => $stmt->errorInfo()
            );
            $result = json_encode($status, true);

            return $result;

        }
 
        $sql="update tb_users set nome = :nome, email = :email, senha = :senha where id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":nome", $this->__get("nome"));
        $stmt->bindValue(":email", $this->__get("email"));
        $stmt->bindValue(":senha", $this->__get("senha"));
        $stmt->bindValue(":id", $this->__get("id"));
        $result = $stmt->execute();

        if($result){
            $status = array(
                'status' => 1,
                'message' => "Dados atualizados com sucesso."
            );
            $result = json_encode($status, true);

        } else {
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro ao atualizar dados.",
                'stmt errorinfo' => $stmt->errorInfo()
            );
            $result = json_encode($status, true);

        }
        
        return $result;
    }

    public function deletar()
    {

    }

    public function listar()
    {

    }

    public function visualizar()
    {
        $sql="select id, nome, email, senha from tb_users where id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $this->__get("id"));
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$result){
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro - Dados não encontrados.",
                'stmt errorinfo' => $stmt->errorInfo()
            );
            $result = json_encode($status, true);

            return $result;

        }

        $status = array(
            'status' => 1,
            'message' => "Dados encontrados com sucesso.",
            'id' => $result['id'],
            'nome' => $result['nome'],
            'email' => $result['email'],
            'senha' => $result['senha']
        );

        $result = json_encode($status, true);

        return $result;

    }


}


?>