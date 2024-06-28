<?php
session_start();
require_once 'config/config.php';
require_once 'autoloader.php';

$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

$requestUri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
$requestUri = trim(parse_url($requestUri, PHP_URL_PATH), '/');
$requestParts = explode('/', $requestUri);

$defaultController = 'Home';
$defaultAction = 'index';

if (empty($requestParts[0])) {
    $requestParts[0] = $defaultController;
}

if (empty($requestParts[1])) {
    $requestParts[1] = $defaultAction;
}


$controllerPath = '';
$action = 'index';

$baseDir = __DIR__ . '/app/Controllers/';
foreach ($requestParts as $part) {
    if (is_dir($baseDir . $controllerPath . ucfirst($part))) {
        $controllerPath .= ucfirst($part) . '/';
    } else {
        $controllerPath .= ucfirst($part);
        break;
    }
}

$controllerNamespace = 'App\\Controllers\\';
$controllerClass = $controllerNamespace . str_replace('/', '\\', $controllerPath) . 'Controller';
$action = isset($requestParts[count(explode('/', $controllerPath))]) ? $requestParts[count(explode('/', $controllerPath))] : 'index';

$requestParts = array_slice($requestParts, count(explode('/', $controllerPath)));

$params = array_values($requestParts);

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();

    if (method_exists($controller, $action)) {
        call_user_func_array([$controller, $action], $params);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo 'Action not found: ' . $action;
    }
} else {
    header("HTTP/1.0 404 Not Found");
    echo 'Controller not found: ' . $controllerClass;
}
?>
