<?php

namespace weather\api\persistence;

require('./city/infrastructure/repository/port/createCityPort.php');

use weather\api\persistence\CreateCityPersistence;
use PDO;

class CreateCityRepository implements CreateCityPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function createCity($city)
    {
        try {
            $sql = "INSERT INTO mstr_city (name,idActualWeather,country,idCoordinate) VALUES ('{$city->getName()}', '{$city->getIdActualWeather()}',
                                 '{$city->getCountry()}', '{$city->getIdCoordinate()}')";
                                 echo $sql;
            $this->db->query($sql);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
