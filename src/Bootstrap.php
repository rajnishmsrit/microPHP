<?php declare(strict_types = 1);

namespace microphp;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'development';

/**
* Register the error handler
*/
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

//throw new \Exception;

$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse;

$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};


$http_pieces=explode("/",$request->getPath());


$real_path="/".end($http_pieces);

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);
//$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
$routeInfo = $dispatcher->dispatch($request->getMethod(), $real_path);

//
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        $class = new $className;
        $class->$method($vars);
        break;
    /*
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func($handler, $vars);
        break;
    */
}

//$content = '<h1>Hello World</h1>';
//$response->setContent($content);

//$response->setContent('404 - Page not found');
//$response->setStatusCode(404);

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

echo $response->getContent();
