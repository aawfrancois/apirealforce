<?php

namespace App\Router;

/**
 * Class Router.
 */
class Router
{
    /**
     * @var array $routes
     */
    public array $routes = [];

    /**
     * Run router
     *
     * @return $this
     */
    public function run(): self
    {
        $uri = $_SERVER['REQUEST_URI'];
        $found = false;

        foreach ($this->routes as $route) {
            $parsedUrl = parse_url($uri);
            if ($parsedUrl === false) {
                continue;
            }
            var_dump($route['path']);
            var_dump($parsedUrl['path']);
            die();
            if ($route['path'] !== $parsedUrl['path'] || $route['method'] !== strtolower($_SERVER['REQUEST_METHOD'])) {
                continue;
            }

            $found = true;
            $explodeCallable = explode('@', $route['callable']);
            if (count($explodeCallable) !== 2) {
                throw new \RuntimeException('invalid callable for the route');
            }

            $controller = new $explodeCallable[0]();
            $action = $explodeCallable[1];
            $controller->$action();
        }

        if (!$found) {
            self::throw404();
        }

        return $this;
    }

    /**
     * @param string $name
     * @param string $method
     * @param string $path
     * @param string $callable
     * @return Router
     */
    public function addRoute(string $name, string $method, string $path, string $callable): self
    {
        $this->routes[$name] = [
            'path' => $path,
            'method' => strtolower($method),
            'callable' => $callable
        ];

        return $this;
    }

    /**
     * @return void
     */
    public static function throw400()
    {
        http_response_code(400);
        exit();
    }

    /**
     * @return void
     */
    public static function throw401()
    {
        http_response_code(401);
        exit();
    }

    /**
     * @return void
     */
    public static function throw403()
    {
        http_response_code(403);
        exit();
    }

    /**
     * @return void
     */
    public static function throw404()
    {
        http_response_code(404);
        exit();
    }
}