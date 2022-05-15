<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/router/Router.php';
require_once __DIR__ . '/router/Route.php';
require_once __DIR__ . '/controllers/Movies.php';
require_once __DIR__ . '/controllers/Drivers.php';
require_once __DIR__ . '/services/Auth.php';

$auth = new services\Auth();

if (!$auth->checkTokenIsValid()) {
    http_response_code(401);
    exit();
}

$router = new router\Router();
$route = new router\Route();
$moviesController = new controllers\Movies();
$driversController = new controllers\Drivers();

if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = '';
}

if (isset($_GET['page']) === false) {
    $route->route('/api?search=' . $search, function () use ($driversController, $search, $moviesController) {

        $driversController->getDataDriverFiltred($search);
        $moviesController->getAllDataFiltred($search);
    });
} else {
    $page = $_GET['page'];

    $route->route('/api?search=' . $search . '&page=' . $page, function () use ($page, $search, $moviesController) {
        $moviesController->getAllDataFiltred($search, (string) $page);
    });
}


$route->route('/404', function () {
    echo "Page not found";
});

$router->run();

