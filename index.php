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

    } catch (PDOException $e) {
        echo '<p>falha na conexão</p>';
        echo '<p>Erro:'.$e->getCode().'</p>';
        echo '<p>Mensagem:'.$e->getMessage().'</p>';
    }


?>