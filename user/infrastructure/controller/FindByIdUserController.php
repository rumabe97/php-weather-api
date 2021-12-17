<?php

namespace weather\api\persistence;

require('./user/infrastructure/repository/findByIdUserRepository.php');

use weather\api\persistence\FindByIdUserRepository;

class FindByIdUserController
{
    private $findByIdUserPersistence;

    function __construct()
    {
        $this->findByIdUserPersistence = new FindByIdUserRepository();
    }

    public function findByIdUser($id)
    {
        return $this->findByIdUserPersistence->findByIdUser($id);
    }
}
