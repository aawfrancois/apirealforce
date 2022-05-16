<?php

namespace App\Services;

class JSONDrivers
{
    /**
     * @return mixed
     */
    public function getDrivers(): mixed
    {
        $json = file_get_contents('./drivers.json');
        return json_decode($json, true);
    }
}