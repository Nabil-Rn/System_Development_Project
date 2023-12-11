<?php


$controller = (isset($_GET['controller'])) ? $_GET['controller'] : "home";
$action = (isset($_GET['action'])) ? $_GET['action'] : "index";
$id = (isset($_GET['id'])) ? intval($_GET['id']) : -1;

$controllerClassName = ucfirst($controller) . "Controller";
include_once "Controllers/$controllerClassName.php";

session_start();
$ct = new $controllerClassName();
$ct->route();


?>