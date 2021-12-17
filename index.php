<?php

require('./user/infrastructure/controller/dto/InputUserDTO.php');

use weather\api\persistence\InputUserDTO;

require('./user/infrastructure/controller/dto/OutputUserDTO.php');

use weather\api\persistence\OutuputUserDTO;

require('./city/infrastructure/controller/dto/InputCityDTO.php');

use weather\api\persistence\InputCityDTO;

require('./city/infrastructure/controller/dto/OutputCityDTO.php');

use weather\api\persistence\OutuputCityDTO;

require('./user/infrastructure/controller/findUserController.php');

use  weather\api\persistence\FindUserController;

require('./user/infrastructure/controller/createUserController.php');

use  weather\api\persistence\CreateUserController;

require('./user/infrastructure/controller/FindByIdUserController.php');

use  weather\api\persistence\FindByIdUserController;

require('./user/infrastructure/controller/UpdateUserController.php');

use weather\api\persistence\UpdateUserController;

require('./user/infrastructure/controller/DeleteUserController.php');

use  weather\api\persistence\DeleteUserController;

require('./city/infrastructure/controller/FindByIdCityController.php');

use  weather\api\persistence\FindByIdCityController;

require('./city/infrastructure/controller/createCityController.php');

use  weather\api\persistence\CreatecityController;

require('./city/infrastructure/controller/findCityController.php');

use  weather\api\persistence\FindCityController;

define("BASE_URL", "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]);
define("HOME", $_SERVER["SCRIPT_NAME"]);

const ROUTES = array(
    '/findUser' => FindUserController::class,
    '/createUser' => CreateUserController::class,
    '/updateUser' => UpdateUserController::class,
    '/findByIdUser' => FindByIdUserController::class,
    '/deleteUser' => DeleteUserController::class,
    '/findByIdCity' => FindByIdCityController::class,
    '/createCity' => CreateCityController::class,
    '/findCity' => FindCityController::class,
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

    if ($path === '/findUser') {
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
    if ($path === '/deleteUser') {
        $data =  $controller->deleteUser($params['id']);
    }
    if ($path === '/updateUser') {
        $user = new InputUserDTO($params);
        $data = $controller->updateUser($params['id'], $user);
    }

    if ($path === '/findByIdCity') {
        $data =  $controller->findByIdCity($params['id']);
    }
    if ($path === '/createCity') {
        $city = new InputCityDTO($params);
        $data =  $controller->createCity($city);
    }
    echo $data;
}
