<?php

namespace services;

class JSONDrivers
{
    /**
     * Retrieve drivers from json file
     *
     * @return void
     */
    public function getDrivers()
    {
        $json = file_get_contents('./drivers.json');
        return json_decode($json, true);
    }
}