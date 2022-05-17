<?php

namespace App\Controllers;

class Movies extends \App\Controller
{
    /**
     * @return void
     */
    public function search(): void
    {
        $search = null;
        $page = null;

        if (array_key_exists('search', $_GET)) {
            $search = trim($_GET['search']);
        }
        if (array_key_exists('page', $_GET)) {
            $page = (int)$_GET['page'];
        }

        if ($search === null) {
            \App\Router\Router::throw400();
        }

        $moviesService = new \App\Services\OMDbMovie();
        $arraySearchMovies = $moviesService->search($search, $page);

        $result = [];

        if ($arraySearchMovies['Response'] === "True") {
            foreach ($arraySearchMovies['Search'] as $movies) {
                $result['movies'][] = [
                    'id' => $movies['imdbID'],
                    'dataType' => $movies['Type'],
                    'name' => $movies['Title'],
                    'description' => $moviesService->getMoviesById($movies['imdbID'])['Plot'],
                    'photoUrl' => $movies['Poster'],
                ];
            }
        } else {
            $this->renderJson($arraySearchMovies);
        }

        $driversController = new \App\Controllers\Drivers();

        $driverArray = $driversController->getDataDriverFiltred();

        $this->renderJson(array_merge($driverArray, $result));
    }
}