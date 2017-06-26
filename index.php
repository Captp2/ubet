<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
session_start();
require(ROOT.'core/model.php');
require(ROOT.'core/controller.php');
$params = explode('/',$_GET['p']);
$controller = !empty($params[0]) ? $params[0] : 'def';
$action = isset($params[1]) ? $params[1] : 'index';
if (!file_exists('controllers/'.$controller.'Controller.php')){
    require_once('404.php');
}
else{
    require('controllers/'.$controller.'Controller.php');
    $controller = new $controller();
}
if (method_exists($controller, $action)){
    unset($params[0]);
    unset($params[1]);
    call_user_func_array(array($controller,$action),$params);
} else {
    require_once('404.php');
}