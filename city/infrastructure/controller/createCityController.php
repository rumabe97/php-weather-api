<?php

namespace weather\api\persistence;

require('./city/application/createCityUseCase.php');

use weather\api\persistence\CreateCityUseCase;

class CreateCityController
{
    private $createCityUseCase;

    function __construct()
    {
        $this->createCityUseCase = new CreateCityUseCase();
    }

    public function createCity($city)
    {
        $cityClass = $city->toCity($city);
        return $this->createCityUseCase->createCity($cityClass);
    }
}
