<?php

namespace weather\api\persistence;

require('./city/infrastructure/repository/findByIdCityRepository.php');

use weather\api\persistence\FindByIdCityRepository;

class FindByIdCityController
{
    private $findByIdCityPersistence;

    function __construct()
    {
        $this->findByIdCityPersistence = new FindByIdCityRepository();
    }

    public function findByIdCity($id)
    {
        return $this->findByIdCityPersistence->findByIdCity($id);
    }
}
