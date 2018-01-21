<?php

function __autoload($class_name){
    $array_path = array(
        '/components/',
        '/models/'
    );
    foreach ($array_path as $path_name){
        $path = ROOT.$path_name.$class_name.'.php';
        if(is_file($path)){
            include $path;
        }
    }
}

?>