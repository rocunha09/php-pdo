<?php

spl_autoload_register(function($class_name){
    $file = "Models". DIRECTORY_SEPARATOR . $class_name . ".php";

    if(file_exists($file)){
        require_once($file);
    }

});



?>