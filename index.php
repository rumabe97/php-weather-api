<?php

require('./user/domain/IUser.php');
require('./user/infrastructure/controller/findUserController.php');

use  weather\api\persistence\FindUserController as findUserController;

require('./user/infrastructure/controller/createUserController.php');

use  weather\api\persistence\CreateUserController as createUserController;
use weather\api\persistence\User;

define("BASE_URL", "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]);
define("HOME", $_SERVER["SCRIPT_NAME"]);

const ROUTES = array(
    '/login' => FindUserController::class,
    '/createUser' => CreateUserController::class,
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
        return $controller->findUser($params['email'], $params['password'], $controller);
    }
    if ($path === '/createUser') {
        $user = new User($params);
        return $controller->createUser($user);
    }
}
