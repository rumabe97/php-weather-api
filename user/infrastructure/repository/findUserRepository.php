<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/port/findUserPort.php');
require('./user/infrastructure/controller/dto/OutputUserDTO.php');

use weather\api\persistence\OutuputUserDTO;
use weather\api\persistence\FindUserPersistence;
use PDO;

class FindUserRepository implements FindUserPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function findUser($user)
    {
        $result = $this->selectString($user);
        $sql = "SELECT * FROM mstr_user $result";

        $user = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($user as $value) {
            $u = new OutuputUserDTO($value);
            echo json_encode($u->expose());
            return;
        }
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
        return rtrim($result, "and ");
    }
}
