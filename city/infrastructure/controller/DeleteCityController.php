<?php

namespace weather\api\persistence;

require('./city/infrastructure/repository/DeleteCityRepository.php');

use weather\api\persistence\DeleteCityRepository;

class DeleteCityController
{
    private $deleteCityPersistence;

    function __construct()
    {
        $this->deleteCityPersistence = new DeleteCityRepository();
    }

    public function deleteCity($id)
    {
        return $this->deleteCityPersistence->deleteCity($id);
    }
}
