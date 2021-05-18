<?php
    require_once ("autoload.php");
    /*  
    echo "<pre>";
    print_r();
    echo "</pre>";
    */
   
    $usuario = new Usuario();
    //print_r($usuario->visualizar(1));

    //$usuario->visualizar(1);
    //echo $usuario;

    
    echo "<pre>";
    print_r($usuario->inserir("Maria", "maria@teste.com.br", "789456"));
    echo "</pre>";

    
?>