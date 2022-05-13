<?php

namespace controllers;

use services\OMDbMovie;

class Movies
{
    public function getAllDataFiltred()
    {
        $movies = new OMDbMovie('d744f309');
        $movies->getMoviesByTitle('hamilton');
    }
}