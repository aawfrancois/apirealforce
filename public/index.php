<?php
var_dump('ici'); die();

require '../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');

$router = new \App\Router\Router();

$auth = new \App\Services\Auth();
if (!$auth->checkTokenIsValid()) {
    \App\Router\Router::throw401();
}

$router->addRoute('search-get', 'get', '/search', '\App\Controllers\Movies@search');

$router->run();

