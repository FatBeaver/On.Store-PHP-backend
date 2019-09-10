<?php 
// ==== FRONT CONTROLLER ====

//---------REPORTING ERRORS
ini_set('dispaly_errors', 1);
error_reporting(E_ALL);

setlocale(LC_ALL, '');
//---------SESSION
session_start();

//---------conts ROOT PROJECT
define('ROOT', __DIR__);

//---------CLASS AUTOLOADER
require_once ROOT . '/components/Autoload.php';
if (Auth::isGuest()) {
   Auth::CookieAuth();
}
//---------ROUTER 
$router = new Router();
$router->run();