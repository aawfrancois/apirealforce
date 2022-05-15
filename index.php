<?php
require __DIR__ . '/vendor/autoload.php';
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/router/Router.php';
require_once __DIR__ . '/router/Route.php';
require_once __DIR__ . '/controllers/Movies.php';
require_once __DIR__ . '/controllers/Drivers.php';
require_once __DIR__ . '/services/Auth.php';

$router = new router\Router();
$route = new router\Route();
$moviesController = new controllers\Movies();
$driversController = new controllers\Drivers();

$auth = new services\Auth();
if (!$auth->checkTokenIsValid()) {
    echo '401 unauthorized';
    http_response_code(401);
    exit();
}

$search = $_GET['search'] ?? '';

if (isset($_GET['page']) === false) {
    $route->route('/api?search=' . $search, function () use ($driversController, $search, $moviesController) {

        $driverArray = $driversController->getDataDriverFiltred($search);
        $moviesArray = $moviesController->getAllDataFiltred($search);

        echo json_encode(array_merge($driverArray, $moviesArray));
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

