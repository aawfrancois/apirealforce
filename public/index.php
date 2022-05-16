<?php
require '../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');

$router = new \App\Router\Router();



$moviesController = new controllers\Movies();
$driversController = new controllers\Drivers();

$auth = new Services\Auth();
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

