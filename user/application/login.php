<?php

namespace application\Login;

class Login
{

    function login($username, $password, $service)
    {
        $user = $service->login($username, $password);
        return $user;
    }
}
