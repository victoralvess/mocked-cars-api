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
    $r->addRoute('GET', '/', function ($request) {
        return 'GET / - OK';
    });

    $r->addRoute('GET', '/cars[/{action:all}]', 'CarsHandler');
    $r->addRoute('POST', '/cars[/{action:add|remove}[/{id:\d+}]]', 'CarsHandler');
});

$middlewares[] = new ErrorHandler($container->get('ErrorHandler'));
$middlewares[] = new FastRoute($dispatcher);
$middlewares[] = new RequestHandler($container);

$relay = new Relay($middlewares);
$response = $relay->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();
$emitter->emit($response);
