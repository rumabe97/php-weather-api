<?php

namespace weather\api\persistence;

require('./city/infrastructure/repository/findCityRepository.php');

use weather\api\persistence\FindCityRepository;

class FindCityController
{
    private $findCityPersistence;

    function __construct()
    {
        $this->findCityPersistence = new FindCityRepository();
    }

    public function findcity($city)
    {
        $cityClass = $city->toUser();
        return $this->findCityPersistence->findCity($cityClass);
    }
}
