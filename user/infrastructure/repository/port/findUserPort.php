<?php

namespace weather\api\persistence;

interface FindUserPersistence
{
    function findUser($username, $password);
}
