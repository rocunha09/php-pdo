<?php

    if(!empty($_POST['usuario']) && !empty($_POST['senha'])){

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
            /*
            $sql='insert into tb_users( nome, email, senha) values("nique", "nique@teste.com.br", "654321")';

            try {
                $retorno = $conexao->exec($sql);
                echo '<p>registro inserido com sucesso</p>';
            } catch (PDOException $e) {
                echo '<p>falha ao realizar registro</p>';
                echo '<p>Erro:'.$e->getCode().'</p>';
                echo '<p>Mensagem:'.$e->getMessage().'</p>';
            }
            */

            // deletando registros no db
            /*
            $sql='delete from tb-users where id=2';

            try {
                $retorno = $conexao->exec($sql);
                echo '<p>registro excluído com sucesso</p>';
            } catch (PDOException $e) {
                echo '<p>falha ao realizar exclusão</p>';
                echo '<p>Erro:'.$e->getCode().'</p>';
                echo '<p>Mensagem:'.$e->getMessage().'</p>';
            }
            */

            //listando registros atráves de uma consulta no db
            /*
            $sql='select * from tb_users';

            try {
                $stmt = $conexao->query($sql);
                $lista = $stmt->fetchALL(PDO::FETCH_OBJ); //FETCH_NUM || FETCH_ASSOC || FETCH_BOTH || FETCH_OBJ

                //FETCH_NUM 
                //retorna o valor contido na posição [0] da lista e acesa outro array, e acessa a posição [1] referente ao nome.
                
                //echo $lista[0][1];
                //FETCH_ASSOC 
                //retorna o valor contido na posição [0] da lista e acesa outro array, e acessa o indice ['email'] referente ao email.
                //echo $lista[0]['email']; 
                
                //FETCH_OBJ 
                //retorna o valor contido na posição [0] da lista que e acesa um objeto, e acessa o atributo email deste objeto.
                //echo $lista[0]->email;

                echo '<hr>';
                
                foreach ($lista as $value) {
                    //print_r($value);
                    echo $value->email;
                    echo '<hr>';
                }

            } catch (PDOException $e) {
                echo '<p>falha ao realizar consulta</p>';
                echo '<p>Erro:'.$e->getCode().'</p>';
                echo '<p>Mensagem:'.$e->getMessage().'</p>';
            }
            */

            // consultando apenas 1 registro no db
            /*
            $id = 3;
            $sql='select * from tb_users where id =' .$id;

            try {
                $stmt = $conexao->query($sql);
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                echo '<pre>';
                print_r($user);
                echo '</pre>';

                echo $user->email;
                echo '<hr>';

            } catch (PDOException $e) {
                echo '<p>falha ao realizar consulta</p>';
                echo '<p>Erro:'.$e->getCode().'</p>';
                echo '<p>Mensagem:'.$e->getMessage().'</p>';
            }
            */

            //consultando banco procurando o valor recebido por POST
            //testando SQL injection através do campo senha com a instrução abaixo inserida após a senha digitada
            //'; delete from tb_users where 'a' = 'a
            $sql="select * from tb_users where"; 
            $sql .= " email ='{$_POST['usuario']}'";
            $sql .= " and senha ='{$_POST['senha']}'";

            echo $sql;
            
            $stmt = $conexao->query($sql);
            $usuario = $stmt->fetch();

            echo '<pre>';
            print_r($usuario);
            echo '</pre>';

        } catch (PDOException $e) {
            echo '<p>falha na conexão</p>';
            echo '<p>Erro:'.$e->getCode().'</p>';
            echo '<p>Mensagem:'.$e->getMessage().'</p>';
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
</head>
<body>
    <hr>
    <form action="index.php" method="post">
        <label for="usuario">Email:</label><br>
        <input type="text" name="usuario" id="usuario"><br>
        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" id="senha"><br>
        <button type="submit">Entrar</button>
    </form>
    
</body>
</html>