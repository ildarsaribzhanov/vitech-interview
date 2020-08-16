<?php


use DI\Container;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addGroup('/api', function (RouteCollector $r) {
        $r->addRoute('GET', '', 'HomeController@info');
        $r->addRoute('POST', '/order', 'OrderController@create');
        $r->addRoute('POST', '/fill-products', 'ProductController@fill');
        $r->addRoute('GET', '/product/{id:[0-9]+}', 'ProductController@getOne');
    });
});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri        = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

$request = ServerRequestFactory::fromGlobals();

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        $response = new JsonResponse(['message' => "Not found"], 404);
        break;

    case Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed";
        break;

    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars    = $routeInfo[2];
        [$class, $method] = explode("@", $handler, 2);
        $class = "App\\Controllers\\" . $class;

        array_unshift($vars, $request);
        $container  = new Container();
        $controller = $container->get($class);
        $response   = $controller->$method(...$vars);
        break;

    default:
        $response = new JsonResponse(['message' => "Not found"], 404);
}

if ($response) {
    $emitter = new SapiEmitter();
    $emitter->emit($response);
}