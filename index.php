<?php

require_once 'controllers/Movies.php';

$movies = new \Movies;
$movies->getAllDataFiltred();

var_dump($movies);