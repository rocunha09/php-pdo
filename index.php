<?php
    require_once "Models/DataBase.php";

    $db = New DataBase("localhost", 3307, "db_pdo", "root", "");
    $db->conectar();

    /* criando tabela no banco 

    $db->create("tb_users", array(
        "id int not null primary key auto_increment",
        "nome varchar(50) not null",
       " email varchar(100) not null",
        "senha varchar(32) not null"
    ));
    */
?>
