<?php
    require_once "Models/DataBase.php";
    require_once "Models/Usuario.php";

    $db = New DataBase("localhost", 3306, "db_pdo", "root", "");
    $usuario = New Usuario($db->getDb());

    //criando tabela no banco 
    /*
    $db->create("tb_users", array(
        "id int not null primary key auto_increment",
        "nome varchar(50) not null",
        "email varchar(100) not null",
        "senha varchar(32) not null"
    ));
    */

    /*
        antes de mais nada deve ser definidos os valores dos atributos de $usuario para realizar uma operação 
        e para realizar as operações basta chamar o método desejado:
        $usuario->inserir(); //insere: nome, email, senha
        $usuario->atualizar(); //atualiza: nome, email, senha, no id definido
        $usuario->deletar(); //deleta registro completo da do banco de dados no id definido
        $usuario->listar(); //lista todos usuarios registrados na tabela tb_users
        $usuario->visualizar(); //consulta: nome, email, senha, no id definido
    */

    $usuario->__set("nome", "Joaquina");
    $usuario->__set("email", "Joaquina@teste.com.br");
    $usuario->__set("senha", "123456");
    $usuario->__set("id", "3");



    print_r($usuario->visualizar());

    
?>
