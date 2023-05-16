<?php
//FRONT CONTROLLER 
// settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

// add system files
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');

// db connection 

// call router
$router = new Router();
$router->run();
?>