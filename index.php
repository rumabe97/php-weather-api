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
    $route = explode('/', $path);
    $serviceClass = ROUTES['/' . $route[1]];
    $service = new $serviceClass();
    if ($path === '/login') {
        $login = new findUserController();
        return $login->findUser($params['email'], $params['password'], $service);
    }
}
