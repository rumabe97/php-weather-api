<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/port/findUserPort.php');

use weather\api\persistence\FindUserPersistence;
use PDO;

class FindUserRepository implements FindUserPersistence
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function findUser($email, $password)
    {
        $sql = "SELECT * FROM mstr_user WHERE email ='$email' AND password = '$password'";
        $user = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $data = [];
        foreach ($user as $value) {
            array_push($data, $value);
        }
        $array["user"] = $data;

        echo json_encode($array);
        return null;
    }
}
