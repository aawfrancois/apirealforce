<?php

use router\Router\Router;

require_once 'router/Router.php';

$router = new Router($_GET['url']);
$router->get('/', function($id){ echo "Bienvenue sur ma homepage !"; });
$router->get('/posts/:id', function($id){ echo "Voila l'article $id"; });
$router->run();

