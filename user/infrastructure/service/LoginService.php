<?php

require_once './user/infrastructure/service/LoginAbstractService.php';

class LoginService extends LoginAbstractService
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=weather', 'root', 'root');
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM mstr_user WHERE email = $email AND password = $password";
        echo $sql;
        $user = $this->db->query($sql);
        $data = [];
        foreach ($user as $value) {
            array_push($data, $value);
        }
        $array["user"] = $data;

        echo json_encode($array);
        return null;
    }
}
