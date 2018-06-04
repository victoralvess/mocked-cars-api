<?php
declare(strict_types = 1);

namespace App;

use App\Handlers\ErrorRequestHandler;
use Relay\Relay;
use Middlewares\FastRoute;
use Middlewares\ErrorHandler;
use Middlewares\RequestHandler;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\Response;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$routes = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/info', function ($request) {
        return phpinfo();
    });
});


$middlewares[] = new ErrorHandler(new ErrorRequestHandler());
$middlewares[] = new FastRoute($routes);
$middlewares[] = new RequestHandler();

$relay = new Relay($middlewares);
$response = $relay->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();
$emitter->emit($response);

