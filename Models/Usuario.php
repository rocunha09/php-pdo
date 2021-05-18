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

    public function inserir($nome, $email, $senha)
    {
        $this->__set("nome", $nome);
        $this->__set("email", $email);
        $this->__set("senha", $senha);

        $sql = new DataBase();
        
        $result = $sql->query("insert into tb_users( nome, email, senha) values (:nome, :email, :senha)", array(
            ":nome" => $this->__get("nome"),
            ":email" => $this->__get("email"),
            ":senha" => $this->__get("senha")
        ));

        $result = $result->errorInfo();

        if($result[0] == 0){
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

    public function atualizar($id, $nome, $email, $senha)
    {
        $result = $this->visualizar($id);
        $not_find = json_decode($result, true);
        
        if(!$not_find['status']){
            return $result;
        }

        $this->__set("id", $id);
        $this->__set("nome", $nome);
        $this->__set("email", $email);
        $this->__set("senha", $senha);

        $sql = new DataBase();
        
        $result = $sql->query("update tb_users set nome = :nome, email = :email, senha = :senha where id = :id", array(
            ":nome" => $this->__get("nome"),
            ":email" => $this->__get("email"),
            ":senha" => $this->__get("senha"),
            ":id" => $this->__get("id")
        ));
               
        $result = $result->errorInfo();

        if($result[0] == 0){
            $status = array(
                'status' => 1,
                'message' => "Dados atualizados com sucesso."
            );
            $result = json_encode($status, true);

        } else {
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro ao atualizar dados.",
                'stmt errorinfo' => $result->errorInfo()
            );
            $result = json_encode($status, true);

        }
        
        return $result;
    }

    public function deletar($id)
    {
        $result = $this->visualizar($id);
        $not_find = json_decode($result, true);
        
        if(!$not_find['status']){
            return $result;
        }

        $sql = new DataBase();

        $result = $sql->query("delete from tb_users where id = :id", array(
            ":id" => $id
        ));

        if($result){
            $status = array(
                'status' => 1,
                'Menssagem' => "Dados referente ao id: {$this->__get("id")} deletados com sucesso.",
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
        $sql = new DataBase();
        $result = $sql->select("select id, nome, email, senha from tb_users");

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
        
        if($result == NULL){
            $status = array(
                'status' => 0,
                'Menssagem' => "Erro - Dados não encontrados."
            );

            $result = json_encode($status, true);

        } else {
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
        }   

        return $result;

    }

    public function __toString()
    {

        if($this->__get("id") == null){
            return json_encode(array(
                'status' => 0,
                'Menssagem' => "Erro - Dados não encontrados."
            ));

        }

        return json_encode(array(
            "id" => $this->__get("id"),
            "nome" => $this->__get("nome"),
            "email" => $this->__get("email"),
            "senha" => $this->__get("senha")
        ));
    }

}


?>