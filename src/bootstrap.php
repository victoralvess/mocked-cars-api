<?php
declare(strict_types = 1);

namespace App;

require_once dirname(__DIR__) . '/vendor/autoload.php';

use DI\ContainerBuilder;
use Relay\Relay;
use Middlewares\{ErrorHandler, FastRoute, RequestHandler};
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$builder = new ContainerBuilder();
$builder->useAutowiring(false);
$builder->addDefinitions(__DIR__ . '/container-definitions.php');
$container = $builder->build();

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $routes = require(__DIR__ . '/routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
});

$middlewares[] = new ErrorHandler($container->get('ErrorHandler'));
$middlewares[] = new FastRoute($dispatcher);
$middlewares[] = new RequestHandler($container);

$relay = new Relay($middlewares);
$response = $relay->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();
$emitter->emit($response);
