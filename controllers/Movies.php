<?php

namespace controllers;

use services\OMDbMovie;

class Movies
{
    /**
     * @param $search
     * @param $page
     * @return void
     */
    public function getAllDataFiltred($search, $page = null)
    {
        require_once('./services/OMDbMovie.php');

        $moviesService = new OMDbMovie('d744f309');
        $arraySearchMovies = $moviesService->getMoviesBySearch((string) $search, $page);

        $result = [];

        if ($arraySearchMovies['Response'] === "True") {
            foreach ($arraySearchMovies['Search'] as $movies) {
                $result[] = [
                    'id' => $movies['imdbID'],
                    'dataType' => $movies['Type'],
                    'name' => $movies['Title'],
                    'description' =>  $moviesService->getMoviesById($movies['imdbID'])['Plot'],
                    'photoUrl' => $movies['Poster'],
                ];
            }
        } else {
            echo json_encode($arraySearchMovies);
        }

        echo json_encode($result);
    }
}