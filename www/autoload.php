<?php


spl_autoload_register('__autoload');

function __autoload($class){
    $path = strtr($class, '\\', '/') . '.php';

    if (file_exists($path))
        include_once($path);
    else{
        throw new \Exception('class not found');
    }
}