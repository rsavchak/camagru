<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
define ('ROOT', dirname(__FILE__));
 date_default_timezone_set("Europe/Kiev");
session_start();
require_once (ROOT . '/components/Autoload.php');
$router = new Router();
$router->run();