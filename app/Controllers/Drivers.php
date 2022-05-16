<?php

namespace Controllers;

class Drivers
{
    /**
     * @param string $search
     * @return array
     */
    public function getDataDriverFiltred(string $search): array
    {
        require_once('./Services/JSONDrivers.php');

        $driversService = new JSONDrivers();
        $arrayDrivers = $driversService->getDrivers();

        $drivers = [];

        foreach ($arrayDrivers['drivers'] as $driver) {
            $find = str_contains(strtolower($driver['name']), strtolower($search));
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

        return $drivers;
    }
}