<?php

namespace weather\api\persistence;

require('./user/domain/IUser.php');

use weather\api\persistence\User;

class InputUserDTO
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $surname;

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
