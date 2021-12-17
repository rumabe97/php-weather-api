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
            $sql = $this->getInsertString('mstr_city', $city);
            echo $sql;
            $this->db->query($sql);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function getInsertString($tableName, $values)
    {
        $keys = array_keys($values);
        $values = array_values($values);
        $stringKeys = $this->getStringFormat($keys, true);
        $stringValues = $this->getStringFormat($values);

        return "insert into {$tableName}({$stringKeys}) values ({$stringValues})";
    }

    private function getStringFormat($value, $iskey = false)
    {
        $result = '';
        $properties = $value->expose();
        foreach ($properties as $key => $value) {
            if (!isset($value)) {
                continue;
            }
            if (gettype($value) === 'string' && !$iskey) $value = "'" . $value . "'";

            $result = $result .  $value . ",";
        }
        return rtrim($result, ",");
    }
}
