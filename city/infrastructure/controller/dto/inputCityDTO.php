<?php

namespace weather\api\persistence;

require('./city/domain/City.php');

use weather\api\persistence\User;

class InputCityDTO
{
    private $id;
    private $name;
    private $idActualWeather;
    private $country;
    private $idCoordinate;

    public function __construct($value)
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            if (isset($value[$propertyName])) {
                $this->$propertyName = $value[$propertyName];
            }
        }
    }

    public function toUser()
    {
        return new User($this->expose());
    }

    public function expose()
    {
        return get_object_vars($this);
    }
}
