<?php

namespace App\Router;

/**
 * Class Router.
 */
class Router
{
    /**
     * @return void
     */

    public array $routes = [];

    function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $found = false;

        foreach ($this->routes as $path => $callback) {
            if ($path !== $uri) continue;

            $found = true;
            $callback();
        }

        if (!$found) {
            $notFoundCallback = $this->routes['/404'];
            $notFoundCallback();
        }
    }
    public function addRoute(string $name, string $path, callable $callable): void
    {
        $this->routes[$name] = [
            'path' => $path,
            'callable' => $callable,
        ];
    }

}