<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/createUserRepository.php');

use weather\api\persistence\CreateUserRepository;

class CreateUserController
{
    private $createUserPersistence;

    function __construct()
    {
        $this->createUserPersistence = new CreateUserRepository();
    }

    public function createUser($user)
    {
        return $this->createUserPersistence->createUser($user);
    }
}
