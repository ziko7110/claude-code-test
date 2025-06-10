<?php

function redirect($url) {
    header("Location: $url");
    exit();
}

function view($template, $data = []) {
    extract($data);
    ob_start();
    include __DIR__ . "/resources/views/$template.php";
    return ob_get_clean();
}

function session($key = null, $value = null) {
    if ($key === null) {
        return $_SESSION;
    }
    
    if (is_array($key)) {
        foreach ($key as $k => $v) {
            $_SESSION[$k] = $v;
        }
        return;
    }
    
    if ($value === null) {
        return $_SESSION[$key] ?? null;
    }
    
    $_SESSION[$key] = $value;
}

function old($key, $default = '') {
    return $_SESSION['old'][$key] ?? $default;
}

function route($name, $params = []) {
    $routes = [
        'todos.index' => '/',
        'todos.create' => '/todos/create',
        'todos.store' => '/todos',
        'todos.show' => '/todos/' . ($params[0] ?? '{id}'),
        'todos.edit' => '/todos/' . ($params[0] ?? '{id}') . '/edit',
        'todos.update' => '/todos/' . ($params[0] ?? '{id}'),
        'todos.destroy' => '/todos/' . ($params[0] ?? '{id}'),
        'todos.toggle' => '/todos/' . ($params[0] ?? '{id}') . '/toggle',
    ];
    
    return $routes[$name] ?? '/';
}

function now() {
    return new DateTime();
}

function csrf_field() {
    return '<input type="hidden" name="_token" value="' . ($_SESSION['_token'] ?? '') . '">';
}

function method_field($method) {
    return '<input type="hidden" name="_method" value="' . $method . '">';
}

function collect($items) {
    return new ArrayCollection($items);
}

class ArrayCollection {
    private $items;
    
    public function __construct($items) {
        $this->items = $items;
    }
    
    public function sortByDesc($key) {
        usort($this->items, function($a, $b) use ($key) {
            return strcmp($b[$key], $a[$key]);
        });
        return $this;
    }
    
    public function values() {
        return array_values($this->items);
    }
    
    public function firstWhere($key, $value) {
        foreach ($this->items as $item) {
            if ($item[$key] === $value) {
                return $item;
            }
        }
        return null;
    }
    
    public function search($callback) {
        foreach ($this->items as $index => $item) {
            if ($callback($item)) {
                return $index;
            }
        }
        return false;
    }
    
    public function reject($callback) {
        return new self(array_filter($this->items, function($item) use ($callback) {
            return !$callback($item);
        }));
    }
    
    public function all() {
        return $this->items;
    }
}