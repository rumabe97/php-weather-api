<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/port/DeleteUserPort.php');

use weather\api\persistence\DeleteUserPersistence;
use PDO;

class DeleteUserRepository implements DeleteUserPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function deleteUser($id)
    {
        try {
            $sql = "DELETE from mstr_user where id={$id}";

            $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
