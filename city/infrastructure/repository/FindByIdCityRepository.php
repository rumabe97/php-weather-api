<?php

namespace weather\api\persistence;

require('./city/infrastructure/repository/port/FindByIdCityPort.php');

use weather\api\persistence\FindByIdCityPersistence;
use PDO;

class FindByIdCityRepository implements FindByIdCityPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function findByIdCity($id)
    {
        $sql = "SELECT * FROM mstr_city where id = {$id}";

        $city = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($city as $value) {
            $u = new OutuputCityDTO($value);
            return json_encode($u->expose());
        }
    }
}
