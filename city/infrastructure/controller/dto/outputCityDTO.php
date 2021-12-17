<?php

namespace weather\api\persistence;

class OutuputUserDTO
{
    private $id;
    private $name;
    private $actualWeather;
    private $country;
    private $coordinate;

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

    public function expose()
    {
        return get_object_vars($this);
    }
}
