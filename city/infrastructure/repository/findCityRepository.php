<?php

namespace weather\api\persistence;

require('./city/infrastructure/repository/port/findCityPort.php');

use weather\api\persistence\FindCityPersistence;
use PDO;

class FindCityRepository implements FindCityPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function findCity($city)
    {
        $result = $this->selectString($city);
        $sql = "SELECT * FROM mstr_city $result";

        $c = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($c as $value) {
            $u = new OutuputCityDTO($value);
            array_push($result, $u->expose());
        }
        $data['cities'] = $result;
        return json_encode($data);
    }

    private function selectString($values)
    {
        $result = 'where ';
        $properties = $values->expose();

        foreach ($properties as $key => $value) {
            if (empty($value)) {
                continue;
            }
            if (gettype($value) === 'string') $value = "'" . $value . "'";
            $result = $result . "{$key}={$value}" . " and ";
        }
        if ($result == 'where ') {
            return '';
        }

        return rtrim($result, "and ");
    }
}
