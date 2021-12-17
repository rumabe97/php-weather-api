<?php

namespace weather\api\persistence;

require('./city/infrastructure/repository/createCityRepository.php');

use weather\api\persistence\CreateCityRepository;

class CreateCityUseCase
{
    private $createCityPersistence;
    private $findCityPersistence;

    function __construct()
    {
        $this->createCityPersistence = new CreateCityRepository();
        $this->findCityPersistence = new FindCityRepository();
    }

    public function createCity($city)
    {
        $state = $this->createCityPersistence->createCity($city);

        if ($state) {
            $input = new InputCityDTO($city->expose());
            return $this->findCityPersistence->findCity($input);
        } else {
            throw new \Exception('User already exists');
        }
    }
}
