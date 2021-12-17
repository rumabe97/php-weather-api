<?php

namespace weather\api\persistence;

require('./city/infrastructure/repository/port/DeleteCityPort.php');

use weather\api\persistence\DeleteCityPersistence;
use PDO;

class DeleteCityRepository implements DeleteCityPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function deleteCity($id)
    {
        try {
            $sql = "DELETE from mstr_city where id={$id}";

            $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
