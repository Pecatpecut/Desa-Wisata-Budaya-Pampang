<?php
define('ROOT', dirname(dirname(__DIR__)));

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'];
$script   = dirname($_SERVER['SCRIPT_NAME']);
$base     = rtrim($protocol . '://' . $host . $script, '/');
define('BASE_URL', $base);

session_start();

spl_autoload_register(function($class) {
    $paths = [
        ROOT . '/app/core/'        . $class . '.php',
        ROOT . '/app/controllers/' . $class . '.php',
        ROOT . '/app/models/'      . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) { require_once $path; return; }
    }
});

require_once ROOT . '/app/core/Database.php';
require_once ROOT . '/app/core/Controller.php';
require_once ROOT . '/app/core/Router.php';

$router = new Router();
$router->dispatch();
