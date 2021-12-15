<?php

require('./user/domain/IUser.php');
require('./user/infrastructure/controller/findUserController.php');

use  weather\api\persistence\FindUserController as findUserController;

define("BASE_URL", "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]);
define("HOME", $_SERVER["SCRIPT_NAME"]);

const ROUTES = array(
    '/login' => FindUserController::class,
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
        $login = new findUserController();
        return $login->findUser($params['email'], $params['password'], $controller);
    }
}
