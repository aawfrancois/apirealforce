<?php

use router\Router\Router;

require_once 'router/Router.php';

$router = new Router();

$router->get('/api', function () {
    var_dump('ici');
});

$router->run();

