<?php

require('./user/domain/IUser.php');
require('./user/infrastructure/service/LoginService.php');

require_once('./user/application/login.php');

use application\login\Login as login;

define("BASE_URL", "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]);
define("HOME", $_SERVER["SCRIPT_NAME"]);

const ROUTES = array(
    '/login' => LoginService::class,
);

$cleaned_path = str_replace(HOME, "", $_SERVER["REQUEST_URI"]);
$path = parse_url($cleaned_path)["path"];
$params = array_merge($_POST, $_GET);

//validateToken($api);
handleRequest($path, $params);


/**
 * Procesa la petición realizada con el controlador que corresponda.
 *
 * @param string $path Ruta relativa dentro de la aplicación
 * @param array $params Parámetros para el controlador
 */
function handleRequest($path, $params)
{
    $route = explode('/', $path);
    $serviceClass = key_exists('/' . $route[1], ROUTES)
        ? ROUTES['/' . $route[1]]
        : LoginController::class;
    $service = new $serviceClass();
    if ($path === '/login') {
        $login = new Login();
        return $login->login($params['email'], $params['password'], $service);
    }
}

function validateToken($api)
{
    $controller = new ApiRestController($api);
    if (!isset($_SESSION['usuario'])) {
        return;
    }
    if ($controller->isTokenExpired($_SESSION['token'])) {
        $newToken = $api->getToken($_SESSION["usuario"]->getCorreo(), $_SESSION["usuario"]->getClave(), BASE_URL . "/getToken");
        $_SESSION['token'] = json_decode($newToken, true)['token'];
    }
}
