<?php

require_once 'services/OMDbMovie.php';

class Movies
{
    public function getAllDataFiltred()
    {
        $movies = new OMDbMovie('d744f309');
        $movies->getMoviesByTitle('hamilton');
    }
}