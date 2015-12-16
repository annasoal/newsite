<?php
spl_autoload_register('__autoload');

function __autoload($class)
{
    $path = __DIR__. '/' . strtr($class, '\\', '/') . '.php';

    if (is_readable($path)) {
        require($path);
    } else {
        throw new \Exception('class not found');
    }

}