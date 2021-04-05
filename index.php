<?php
    $host = 'localhost;';
    $db = 'php-pdo';
    $user = 'root';
    $password = '';
    try {
        $conexao = new PDO('mysql:hostname='.$host.'dbname='.$db, $user, $password);
        //echo '<p>conexao realizada com sucesso</p>';

        //criando tabela no db
        /*
        $sql='create table tb_users(
            id int not null primary key auto_increment,
            nome varchar(50) not null,
            email varchar(100) not null,
            senha varchar(32) not null
        )';

        $retorno = $conexao->exec($sql);
        if (!$retorno) {
            echo '<p>Tabela criada com sucesso.</p>';
        } else {
            echo '<p>falha ao criar tabela.</p>';
        }
        */

        // inserindo registros no db

        $sql='insert into tb_users( nome, email, senha) values("nique", "nique@teste.com.br", "654321")';

        try {
            $retorno = $conexao->exec($sql);
            echo '<p>registro inserido com sucesso</p>';
        } catch (PDOException $e) {
            echo '<p>falha ao realizar registro</p>';
            echo '<p>Erro:'.$e->getCode().'</p>';
            echo '<p>Mensagem:'.$e->getMessage().'</p>';
        }
        

    } catch (PDOException $e) {
        echo '<p>falha na conexão</p>';
        echo '<p>Erro:'.$e->getCode().'</p>';
        echo '<p>Mensagem:'.$e->getMessage().'</p>';
    }


?>