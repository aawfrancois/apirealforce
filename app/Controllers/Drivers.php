<?php

namespace App\Controllers;

class Drivers
{
    /**
     * @return array
     */
    public function getDataDriverFiltred(): array
    {
        $driversService = new \App\Services\JSONDrivers();
        $arrayDrivers = $driversService->getDrivers();

        $drivers = [];

        if (isset($_GET['search'])) {
            foreach ($arrayDrivers['drivers'] as $driver) {
                $find = str_contains(strtolower($driver['name']), strtolower($_GET['search']));
                if ($find === true) {
                    $drivers['driver'] = [
                        'id' => $driver['id'],
                        'dataType' => 'driver',
                        'name' => $driver['name'],
                        'description' => $driver['bio'],
                        'photoUrl' => $driver['image'],
                    ];
                }
            }
        }

        return $drivers;
    }
}