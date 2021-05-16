<?php

spl_autoload_register(function($class_name){
    $file = "Models/". $class_name . ".php";

    if(file_exists($file)){
        require_once($file);
    }

});



?>