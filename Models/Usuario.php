<?php
require_once "Models/DataBase.php";

class Usuario
{

    private $id;
    private $nome;
    private $email;
    private $senha;

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
        $sql="select count(*) as status from tb_users where id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $this->__get("id"));
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        if($result['status'] == 0){
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro ao deletar dados.",
                'stmt errorinfo' => $stmt->errorInfo()
            );
            $result = json_encode($status, true);

            return $result;

        }

        $sql="delete from tb_users where id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $this->__get("id"));
        $result = $stmt->execute();

        if($result){
            $status = array(
                'status' => 1,
                'Menssagem' => "Dados  referente ao id: {$this->__get("id")} deletados com sucesso.",
            );
            $result = json_encode($status, true);

            return $result;

        } else {
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro ao deletar dados.",
                'stmt errorinfo' => $stmt->errorInfo()
            );
            $result = json_encode($status, true);

        }
        return $result;
 
    }

    public function listar()
    {
        $sql="select id, nome, email, senha from tb_users";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        );

        $status = array_merge($result, $status);

        $result = json_encode($status, true);

        return $result;

    }

    public function visualizar($id)
    {
        $sql = new DataBase();
        $result = $sql->select("select id, nome, email, senha from tb_users where id = :id", 
        array(
            ":id" => $id
        ));
        
        if(!$result){
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro - Dados não encontrados.",
                'stmt errorinfo' => $stmt->errorInfo()
            );
            $result = json_encode($status, true);

            return $result;
        }

        $this->__set("id", $result[0]['id']);
        $this->__set("nome", $result[0]['nome']);
        $this->__set("email", $result[0]['email']);
        $this->__set("senha", $result[0]['senha']);

        $status = array(
            'status' => 1,
            'message' => "Dados encontrados com sucesso.",
            'id' => $this->__get("id"),
            'nome' => $this->__get("nome"),
            'email' => $this->__get("email"),
            'senha' => $this->__get("senha")
        );

        $result = json_encode($status, true);

        return $result;

    }

    public function __toString(){
        return json_encode(array(
            "id" => $this->__get("id"),
            "nome" => $this->__get("nome"),
            "email" => $this->__get("email"),
            "senha" => $this->__get("senha")
        ));
    }

}


?>