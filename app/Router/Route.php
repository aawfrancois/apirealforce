<?php

namespace router;

class Route
{

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    function route(string $path, callable $callback): void
    {
        global $routes;
        $routes[$path] = $callback;
    }
}
