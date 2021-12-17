<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/port/createUserPort.php');

use weather\api\persistence\CreateUserPersistence;
use PDO;

class CreateUserRepository implements CreateUserPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function createUser($user)
    {
        try {

            $sql = $this->getInsertString('mstr_user', $user);
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

    private function getStringFormat($array, $iskey = false)
    {
        $result = '';
        foreach ($array as $value) {
            if (gettype($value) === 'string' && !$iskey) $value = "'" . $value . "'";

            $result = $result .  $value . ",";
        }
        return rtrim($result, ",");
    }
}
