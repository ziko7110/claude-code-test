<?php

require_once __DIR__ . '/SimpleTodoController.php';

$controller = new SimpleTodoController();
$method = $_SERVER['REQUEST_METHOD'];

// Generate CSRF token if not exists
if (!isset($_SESSION['_token'])) {
    $_SESSION['_token'] = bin2hex(random_bytes(32));
}

// Handle CSRF protection for POST requests
if ($method === 'POST' && (!isset($_POST['_token']) || $_POST['_token'] !== $_SESSION['_token'])) {
    http_response_code(403);
    echo "CSRF token mismatch";
    exit();
}

// Handle method override
if ($method === 'POST' && isset($_POST['_method'])) {
    $method = strtoupper($_POST['_method']);
}

// Clear old input
unset($_SESSION['old']);

try {
    switch (true) {
        case $route === '' || $route === '/':
            echo $controller->index();
            break;
            
        case $route === '/todos/create' && $method === 'GET':
            echo $controller->create();
            break;
            
        case $route === '/todos' && $method === 'POST':
            $_SESSION['old'] = $_POST;
            echo $controller->store();
            break;
            
        case preg_match('/^\/todos\/([^\/]+)$/', $route, $matches) && $method === 'GET':
            echo $controller->show($matches[1]);
            break;
            
        case preg_match('/^\/todos\/([^\/]+)\/edit$/', $route, $matches) && $method === 'GET':
            echo $controller->edit($matches[1]);
            break;
            
        case preg_match('/^\/todos\/([^\/]+)$/', $route, $matches) && $method === 'PUT':
            $_SESSION['old'] = $_POST;
            echo $controller->update($matches[1]);
            break;
            
        case preg_match('/^\/todos\/([^\/]+)$/', $route, $matches) && $method === 'DELETE':
            echo $controller->destroy($matches[1]);
            break;
            
        case preg_match('/^\/todos\/([^\/]+)\/toggle$/', $route, $matches) && $method === 'PATCH':
            echo $controller->toggle($matches[1]);
            break;
            
        default:
            http_response_code(404);
            echo "<h1>404 - Page Not Found</h1>";
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "<h1>500 - Internal Server Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}