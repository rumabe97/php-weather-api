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

    public function findUser($user)
    {
        $userClass = $user->toUser();
        return $this->findUserPersistence->findUser($userClass);
    }
}
