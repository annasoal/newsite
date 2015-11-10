<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

setlocale(LC_ALL, 'ru_RU.UTF8');
session_start();
include_once('autoload.php');
include_once('configs.php');


$p = explode('/', $_GET['q']);
$params = [];

foreach($p as $one){
    if($one != '')
        $params[] = $one;
}

$folder = 'Client';

if($params[0] == ADMIN_URL){
    $folder = 'Admin';
    unset($params[0]);
    $params = array_values($params);
}

$c = "\\Controller\\$folder\\";
$c .= isset($params[0]) ? ucfirst($params[0]) : 'Post';

$action = 'action_';
$action .= isset($params[1]) ? $params[1] : 'index';


try{
    $conrtroller = new $c();
    $conrtroller->request($action, $params);
}
catch(\Exception $e){
    $c = '\\Controller\\Page';
    $action = 'action_p404';
    $conrtroller = new $c();
    $conrtroller->request($action, $params);
}
