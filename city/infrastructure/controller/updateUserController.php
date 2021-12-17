<?php

namespace weather\api\persistence;

require('./user/application/updateUserUseCase.php');

use weather\api\persistence\UpdateUserUseCase;

class UpdateUserController
{
    private $updateUserUseCase;

    function __construct()
    {
        $this->updateUserUseCase = new UpdateUserUseCase();
    }

    public function updateUser($id, $user)
    {
        $userClass = $user->toUser();
        return $this->updateUserUseCase->updateUser($id, $userClass);
    }
}
