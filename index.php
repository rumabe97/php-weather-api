<?php

require('./user/infrastructure/controller/dto/InputUserDTO.php');
require('./user/infrastructure/controller/findUserController.php');

use  weather\api\persistence\FindUserController;

require('./user/infrastructure/controller/createUserController.php');

use  weather\api\persistence\CreateUserController;

require('./user/infrastructure/controller/UpdateUserController.php');

use  weather\api\persistence\UpdateUserController;
use weather\api\persistence\InputUserDTO;

define("BASE_URL", "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]);
define("HOME", $_SERVER["SCRIPT_NAME"]);

const ROUTES = array(
    '/login' => FindUserController::class,
    '/createUser' => CreateUserController::class,
    '/updateUser' => UpdateUserController::class,
);

$cleaned_path = str_replace(HOME, "", $_SERVER["REQUEST_URI"]);
$path = parse_url($cleaned_path)["path"];
$params = array_merge($_POST, $_GET);

handleRequest($path, $params);

function handleRequest($path, $params)
{
    $controllerClass = ROUTES[$path];
    $controller = new $controllerClass();
    if ($path === '/login') {
        $user = new InputUserDTO($params);
        return $controller->findUser($user);
    }
    if ($path === '/createUser') {
        $user = new InputUserDTO($params);
        return $controller->createUser($user);
    }
    if ($path === '/createUser') {
        $user = new InputUserDTO($params);
        return $controller->updateUser($params['id'], $user);
    }
}
