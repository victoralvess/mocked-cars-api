<?php
declare(strict_types = 1);

namespace App;

use FastRoute\RouteCollector;
use Relay\Relay;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;
use function FastRoute\simpleDispatcher;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$routes = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/info', function ($request) {
        return phpinfo();
    });
});

$queue[] = new FastRoute($routes);
$queue[] = new RequestHandler();

$relay = new Relay($queue);
$response = $relay->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();
$emitter->emit($response);

