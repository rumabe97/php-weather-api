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

            $sql = "INSERT INTO mstr_user (name, surname, email, password, rol) VALUES ('{$user->getName()}', '{$user->getSurname()}',
                                 '{$user->getEmail()}', '{$user->getPassword()}', '{$user->getRole()}')";
            $this->db->query($sql);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
