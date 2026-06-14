<?php

class Router
{
    private $routes = [];

    public function get($path, $handler)
    {
        $this->add('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->add('POST', $path, $handler);
    }

    public function dispatch($method, $path)
    {
        $path = '/' . trim(parse_url($path, PHP_URL_PATH), '/');

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                return $this->runHandler($route['handler']);
            }
        }

        Response::json([
            'success' => false,
            'message' => 'Không tìm thấy route'
        ], 404);
    }

    private function add($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => '/' . trim($path, '/'),
            'handler' => $handler,
        ];
    }

    private function runHandler($handler)
    {
        if (is_callable($handler)) {
            return $handler();
        }

        [$class, $method] = explode('@', $handler);
        $controller = new $class();

        return $controller->$method();
    }
}
