<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/findUserRepository.php');

use weather\api\persistence\FindUserRepository;

class FindUserController
{
    private $findUserPersistence;

    function __construct()
    {
        $this->findUserPersistence = new FindUserRepository();
    }

    public function findUser($username, $password)
    {
        return $this->findUserPersistence->findUser($username, $password);
    }
}
