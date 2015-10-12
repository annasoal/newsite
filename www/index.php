<?php

//error_reporting(E_ERROR | E_WARNING | E_PARSE);
setlocale(LC_ALL, 'ru_RU.UTF8');
include_once('autoload.php');
include_once('configsDb.php');


$p = explode('/', $_GET['q']);
$params = [];

foreach($p as $one){
    if($one != '')
        $params[] = $one;
}

$c = '\\Controllers_c\\';
$c .= isset($params[0]) ? ucfirst($params[0]) : 'Pages';

$action = 'action_';
$action .= isset($params[1]) ? $params[1] : 'index';

$conrtroller = new $c();
$conrtroller->request($action, $params);