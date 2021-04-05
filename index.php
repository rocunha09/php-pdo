<?php
    $host = 'localhost;';
    $db = 'php-pdo';
    $user = 'root';
    $password = '';
    try {
        $conexao = new PDO('mysql:hostname='.$host.'dbname='.$db, $user, $password);
        echo '<p>conexao realizada com sucesso</p>';

    } catch (PDOException $e) {
        echo '<p>falha na conexão</p>';
        echo '<p>Erro:'.$e->getCode().'</p>';
        echo '<p>Mensagem:'.$e->getMessage().'</p>';
    }


?>