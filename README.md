# php-pdo
Praticando o uso: **PHP** + **PDO** + **MySql**.

Realizando operações de cadastro de usuários, delete, e consultas através do objeto instanciado através da classe nativa do php: **PDO** para saber mais [clique aqui](https://www.php.net/manual/en/class.pdo).

Realizando o recebimento de dados de um form para consulta via POST para realizar testes de **SQL Injection**, e seu posterior tratamento através do **prepare statement** e **bindValue()**.


## Dando continuidade no treino do uso do PDO:
1) Criado todo processo na index.php.
    Entendendo uso do PDO de forma **didática**, nesta etapa tudo é realizado na index.php

2) Desmembrando todo processo fazendo uso de classes.
    Organizando o código **fazendo uso da orientação a objetos**, nesta etapa são criadas e utilizadas classes para encapsular o comportamento, ou as ações de CRUD com o banco, tornando a index o "core" apenas para instância e chamada de cada ação quando for conveniente.

3) Refatorando a classe Usuario para que as interações com o banco de dados ocorram através de um **DAO**.
    nesta etapa a ideia é dividir a responsabilidade para que exista um DAO para chamar as querys do banco, tornando assim a classe Usuario com uma responsabilidade e imutável, além disso em casos em que há diversos programadores os mesmos não precisarão se preocupar com o banco, muito menos ter acesso as credenciais do mesmo, sendo necessário apenas a realização da chamada dos métodos que realização as querys.

