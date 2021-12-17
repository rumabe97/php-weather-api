<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/updateUserRepository.php');

use weather\api\persistence\UpdateUserRepository;

class UpdateUserUseCase
{
    private $updateUserPersistence;
    private $findByIdUserPersistence;

    function __construct()
    {
        $this->updateUserPersistence = new UpdateUserRepository();
        $this->findUserPersistence = new findByIdUserRepository();
    }

    public function updateUser($id, $user)
    {
        $newUser = $this->findUserPersistence->findByIdUser($id);
        $currentUser = new User(json_decode($newUser, true));
        if ($currentUser->getId()) {
            $currentUser->updateWith($user->expose());
            $this->updateUserPersistence->updateUser($id, $currentUser);
            return json_encode($currentUser->expose());
        }
    }
}
