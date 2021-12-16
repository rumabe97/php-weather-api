<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/createUserRepository.php');

use weather\api\persistence\CreateUserRepository;

class CreateUserUseCase
{
    private $createUserPersistence;
    private $findUserPersistence;

    function __construct()
    {
        $this->createUserPersistence = new CreateUserRepository();
        $this->findUserPersistence = new findUserRepository();
    }

    public function createUser($user)
    {
        $state = $this->createUserPersistence->createUser($user);

        if ($state) {
            $input = new InputUserDTO($user->expose());
            return $this->findUserPersistence->findUser($input);
        } else {
            return false;
        }
    }
}
