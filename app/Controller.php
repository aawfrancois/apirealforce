<?php

namespace App;

class Controller
{
    /**
     * Render json response
     *
     * @param array $array
     * @return void
     */
    protected function renderJson(array $array)
    {
        header('Content-Type: application/json');

        echo json_encode($array, JSON_PRETTY_PRINT);
        exit();
    }
}