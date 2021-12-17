<?php

require('./user/infrastructure/controller/dto/InputUserDTO.php');
require('./user/infrastructure/controller/findUserController.php');

use  weather\api\persistence\FindUserController;

require('./user/infrastructure/controller/createUserController.php');

use  weather\api\persistence\CreateUserController;

require('./user/infrastructure/controller/FindByIdUserController.php');

use  weather\api\persistence\FindByIdUserController;

require('./user/infrastructure/controller/UpdateUserController.php');
require('./user/infrastructure/controller/dto/OutputUserDTO.php');

use weather\api\persistence\OutuputUserDTO;
use weather\api\persistence\UpdateUserController;
use weather\api\persistence\InputUserDTO;

define("BASE_URL", "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]);
define("HOME", $_SERVER["SCRIPT_NAME"]);

const ROUTES = array(
    '/login' => FindUserController::class,
    '/createUser' => CreateUserController::class,
    '/updateUser' => UpdateUserController::class,
    '/findByIdUser' => FindByIdUserController::class,
);

$cleaned_path = str_replace(HOME, "", $_SERVER["REQUEST_URI"]);
$path = parse_url($cleaned_path)["path"];
$params = array_merge($_POST, $_GET);

handleRequest($path, $params);

function handleRequest($path, $params)
{
    $controllerClass = ROUTES[$path];
    $controller = new $controllerClass();
    $data = [];

    if ($path === '/login') {
        $user = new InputUserDTO($params);
        $data = $controller->findUser($user);
    }
    if ($path === '/createUser') {
        $user = new InputUserDTO($params);
        $data =  $controller->createUser($user);
    }
    if ($path === '/findByIdUser') {
        $data =  $controller->findByIdUser($params['id']);
    }
    if ($path === '/updateUser') {
        $user = new InputUserDTO($params);
        $data = $controller->updateUser($params['id'], $user);
    }
    echo $data;
}
