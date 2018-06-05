<?php
declare(strict_types = 1);

namespace App;

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Relay\Relay;
use Middlewares\{ErrorHandler, FastRoute, RequestHandler};
use App\Handlers\ErrorRequestHandler;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', function ($request) {
        return 'GET / - OK';
    });  
});

$middlewares[] = new ErrorHandler(new ErrorRequestHandler());
$middlewares[] = new FastRoute($dispatcher);
$middlewares[] = new RequestHandler();

$relay = new Relay($middlewares);
$response = $relay->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();
$emitter->emit($response);
