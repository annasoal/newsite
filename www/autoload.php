<?php

spl_autoload_register('__autoload');

function __autoload($class){
    include_once(strtolower($class[0]) . '/' . $class . '.php');
}