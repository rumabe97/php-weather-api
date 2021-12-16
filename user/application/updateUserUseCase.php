<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/updateUserRepository.php');

use weather\api\persistence\UpdateUserRepository;

class UpdateUserUseCase
{
    private $updateUserPersistence;
    private $findUserPersistence;

    function __construct()
    {
        $this->updateUserPersistence = new UpdateUserRepository();
        $this->findUserPersistence = new findUserRepository();
    }

    public function updateUser($id, $user)
    {
        $findUser = new User($id);
        $newUser = $this->findUserPersistence->findUser($findUser);

        if ($newUser) {
            $currentUser = new User($newUser);
            $currentUser->updateWith($user);
            $this->updateUserPersistence->updateUser($id, $currentUser);
        }
    }
}
