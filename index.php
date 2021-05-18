<?php
    require_once ("autoload.php");

    $usuario = new Usuario();

    $usuario->visualizar(10);

    echo $usuario;

?>