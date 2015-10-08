<?php

//error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('autoload.php');

$p = explode('/', $_GET['q']);
$params = [];

foreach($p as $one){
    if($one != '')
        $params[] = $one;
}

$c = 'C_';
$c .= isset($params[0]) ? ucfirst($params[0]) : 'Pages';

$action = 'action_';
$action .= isset($params[1]) ? $params[1] : 'index';

$id = $params[2];

$conrtroller = new $c();
$conrtroller->$action($id);
$conrtroller->render();
