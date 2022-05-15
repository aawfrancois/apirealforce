<?php

namespace router;

/**
 * Class Router.
 */
class Router {

    /**
     * @return void
     */
    function run()
    {
        global $routes;
        $uri = $_SERVER['REQUEST_URI'];
        $found = false;
        foreach ($routes as $path => $callback) {
            if ($path !== $uri) continue;

            $found = true;
            $callback();
        }

        if (!$found) {
            $notFoundCallback = $routes['/404'];
            $notFoundCallback();
        }
    }
}