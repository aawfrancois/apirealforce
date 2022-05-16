<?php

namespace App\Controllers;

class Movies
{
    /**
     * @param $search
     * @param $page
     * @return array
     */
    public function getAllDataFiltred($search, $page = null): array
    {
        require_once('./Services/OMDbMovie.php');

        $moviesService = new OMDbMovie('d744f309');
        $arraySearchMovies = $moviesService->getMoviesBySearch((string) $search, $page);

        $result = [];

        if ($arraySearchMovies['Response'] === "True") {
            foreach ($arraySearchMovies['Search'] as $movies) {
                $result['movies'][] = [
                    'id' => $movies['imdbID'],
                    'dataType' => $movies['Type'],
                    'name' => $movies['Title'],
                    'description' =>  $moviesService->getMoviesById($movies['imdbID'])['Plot'],
                    'photoUrl' => $movies['Poster'],
                ];
            }
        } else {
            return $arraySearchMovies;
        }

        return $result;
    }
}