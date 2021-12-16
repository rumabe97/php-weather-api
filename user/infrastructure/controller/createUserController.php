<?php

namespace weather\api\persistence;

require('./user/application//createUserUseCase.php');

use weather\api\persistence\CreateUserUseCase;

class CreateUserController
{
    private $createUserUseCase;

    function __construct()
    {
        $this->createUserUseCase = new CreateUserUseCase();
    }

    public function createUser($user)
    {
        return $this->createUserUseCase->createUser($user);
    }
}
