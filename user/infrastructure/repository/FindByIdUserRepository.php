<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/port/FindByIdUserPort.php');

use weather\api\persistence\FindByIdUserPersistence;
use PDO;

class FindByIdUserRepository implements FindByIdUserPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function findByIdUser($id)
    {
        $sql = "SELECT * FROM mstr_user where id = {$id}";

        $user = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($user as $value) {
            $u = new OutuputUserDTO($value);
            return json_encode($u->expose());
        }
    }
}
