<?php
    require_once ("autoload.php");

    $db = New DataBase();

    $usuarios = $db->select("SELECT * FROM tb_users");

    echo json_encode($usuarios);    
   
    
?>
