<?php
spl_autoload_register('__autoload');

function __autoload($class)
{
    $path = __DIR__. '/' . strtr($class, '\\', '/') . '.php';

    if (file_exists($path)) {

        require_once($path);


    }else {
        echo $path;
    }
}