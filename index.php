<?php
require_once 'configs/Config.php'; 
// get controller
$controller = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : DEFAULT_CONTROLLER;

// get action
$action = isset($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;

require_once 'controllers/' . $controller . '.php';

$worksController = new $controller();
$worksController->$action();
?>