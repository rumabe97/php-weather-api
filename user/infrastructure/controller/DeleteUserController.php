<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/DeleteUserRepository.php');

use weather\api\persistence\DeleteUserRepository;

class DeleteUserController
{
    private $deleteUserPersistence;

    function __construct()
    {
        $this->deleteUserPersistence = new DeleteUserRepository();
    }

    public function deleteUser($id)
    {
        return $this->deleteUserPersistence->deleteUser($id);
    }
}
