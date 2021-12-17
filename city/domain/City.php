<?php

namespace weather\api\persistence;

class User
{
    private $id;
    private $name;
    private $idActualWeather;
    private $country;
    private $idCoordinate;

    private $actualWeather;
    private $coordinate;

    //constructor
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

    public function updateWith($user)
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            if (isset($user[$propertyName])) {
                $this->$propertyName = $user[$propertyName];
            }
        }
    }
    public function expose()
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of idActualWeather
     */
    public function getIdActualWeather()
    {
        return $this->idActualWeather;
    }

    /**
     * Set the value of idActualWeather
     *
     * @return  self
     */
    public function setIdActualWeather($idActualWeather)
    {
        $this->idActualWeather = $idActualWeather;

        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of idCoordinate
     */
    public function getIdCoordinate()
    {
        return $this->idCoordinate;
    }

    /**
     * Set the value of idCoordinate
     *
     * @return  self
     */
    public function setIdCoordinate($idCoordinate)
    {
        $this->idCoordinate = $idCoordinate;

        return $this;
    }

    /**
     * Get the value of actualWeather
     */
    public function getActualWeather()
    {
        return $this->actualWeather;
    }

    /**
     * Set the value of actualWeather
     *
     * @return  self
     */
    public function setActualWeather($actualWeather)
    {
        $this->actualWeather = $actualWeather;

        return $this;
    }

    /**
     * Get the value of coordinate
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }
}
