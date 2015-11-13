<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

setlocale(LC_ALL, 'ru_RU.UTF8');
session_start();
include_once('autoload.php');
include_once('configs.php');


$p = explode('/', $_GET['q']);
$params = [];

foreach ($p as $one) {
    if ($one != '')
        $params[] = $one;
}

$folder = 'Client';

if ($params[0] == ADMIN_URL) {
    $folder = 'Admin';
    unset($params[0]);
    $params = array_values($params);
}

$c = "\\Controller\\$folder\\";

if($folder == 'Admin') {
    $c .= isset($params[0]) ? ucfirst($params[0]) : 'Page';
} else {
    $c .= isset($params[0]) ? ucfirst($params[0]) : 'Post';
}


$action = 'action_';
$action .= isset($params[1]) ? $params[1] : 'index';

if ($folder == 'Client' && class_exists($c) != true) {
    $c = '\\Controller\\Client\\Page';
    $action = 'action_page';
}


try {
    $controller = new $c();
    $controller->request($action, $params);
} catch (\Exception $e) {
    $c = '\\Controller\\Admin\\Page';
    $action = 'action_p404';
    $controller = new $c();
    $controller->request($action, $params);
}
