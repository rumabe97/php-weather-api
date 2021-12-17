<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/port/UpdateUserPort.php');

use weather\api\persistence\UpdateUserPersistence;
use PDO;

class UpdateUserRepository implements UpdateUserPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function updateUser($id, $user)
    {
        try {
            $result = $this->updateString($user);
            $sql = "update mstr_user set {$result} where id={$id}";

            $this->db->query($sql);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function updateString($values)
    {
        $result = '';
        $properties = $values->expose();

        foreach ($properties as $key => $value) {
            if (empty($value)) {
                continue;
            }
            if (gettype($value) === 'string') $value = "'" . $value . "'";
            if ($key !== 'id') $result = $result . "{$key}={$value}" . ",";
        }
        return rtrim($result, ",");
    }
}
