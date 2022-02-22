<?php

// Root directory
define('ROOT', __DIR__.DIRECTORY_SEPARATOR);
// Application directory
define('APP', ROOT.'app'.DIRECTORY_SEPARATOR);

$config = parse_ini_file(APP . 'config' . DIRECTORY_SEPARATOR . 'config.ini', true);

// Database
define('DSN', 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['name'] . ';charset=utf8mb4');
define('DB_USER', $config['database']['username']);
define('DB_PASS', $config['database']['password']);

// Autoloader
require_once APP . 'core' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$requestUrl    = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$requestString = substr($requestUrl, strlen($config['app']['baseUrl']));

$urlParams = explode('/', $requestString);
// TODO: Consider security (see comments)
$controllerName = ucfirst($urlParams[2]) . 'Controller';
$actionName     = isset($urlParams[3]) ? strtolower($urlParams[3]) : 'index';
$actionName     = explode('?', $actionName);
$actionName     = isset($actionName[0]) ? $actionName[0] : 'index';

require 'app/controllers/' . $controllerName . '.php';
// Call the action
$controller = new $controllerName;
$controller->$actionName();
