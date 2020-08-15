<?php
require_once __DIR__ . '/vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    //routes for login page && homepage
    $route->addRoute('GET', '/', 'LoginController@show');
    $route->addRoute('POST', '/home', 'HomeController@show');
    $route->addRoute('GET', '/home', 'HomeController@show');
    $route->addRoute('GET', '/{name}', 'CategoryHandlerController@show');

    //routes for creating new category
    $route->addRoute('GET', '/{name}/create', 'CategoryHandlerController@create');
    $route->addRoute('POST', '/store', 'CategoryHandlerController@store');

    //routes for creating sub category
    $route->addRoute('GET', '/{name}/createSubcategory', 'CategoryHandlerController@createSubcategory');
    $route->addRoute('POST', '/storeSubcategory', 'CategoryHandlerController@storeSubcategory');

    //routes for editing existing selected category
    $route->addRoute('GET', '/{name}/edit', 'CategoryHandlerController@edit');
    $route->addRoute('POST', '/update', 'CategoryHandlerController@update');


    //routes for deleting selected categories
    $route->addRoute('POST', '/{name}/delete', 'CategoryHandlerController@delete');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $params = $routeInfo[2];

        [$controller, $method] = explode('@', $handler);
        $controllerPath = '\App\Controllers\\' . $controller;
        echo (new $controllerPath)->{$method}($params);

        break;
}