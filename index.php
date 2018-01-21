<?php

//1. Общие настройки
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//2. Подключение файлов системы
require_once dirname(__FILE__)."/vars.php";
require_once ROOT."/components/router.php";
require_once ROOT."/components/autoload.php";
$routes = require_once ROOT."/config/routes.php";
session_start();
//3. Подключение к БД
//4. Вызов Router
$router = new Router($routes);
$router->run();

?>