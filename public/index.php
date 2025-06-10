<?php

// Simple routing for the Todo app without full Laravel framework
session_start();

$request_uri = $_SERVER['REQUEST_URI'];
$route = parse_url($request_uri, PHP_URL_PATH);

// Simple autoloader for our classes
spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/../';
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Include helper functions
require_once __DIR__ . '/../helpers.php';

// Include route handler
require_once __DIR__ . '/../simple_routes.php';