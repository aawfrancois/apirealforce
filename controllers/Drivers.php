<?php

namespace controllers;

use services\JSONDrivers;

class Drivers
{
    /**
     * @param string $search
     * @return void
     */
    public function getDataDriverFiltred(string $search)
    {
        require_once('./services/JSONDrivers.php');

        $driversService = new JSONDrivers();
        $arrayDrivers = $driversService->getDrivers();

        $drivers = [];

        foreach ($arrayDrivers['drivers'] as $driver) {
            $find = str_contains(strtolower($driver['name']), strtolower($search));
            if ($find === true) {
                $drivers[] = [
                    'id' => $driver['id'],
                    'dataType' => 'driver',
                    'name' => $driver['name'],
                    'description' => $driver['bio'],
                    'photoUrl' => $driver['image'],
                ];
            }
        }

        echo json_encode($drivers);
    }
}