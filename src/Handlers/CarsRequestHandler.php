<?php
declare(strict_types = 1);

namespace App\Handlers;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\TextResponse;
use Zend\Diactoros\Response\JsonResponse;

class CarsRequestHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $httpMethod = strtolower($request->getMethod());
        $actionName = ucwords($request->getAttribute('action', 'Index'));
        $action = $httpMethod . $actionName . 'Action';

        if (!method_exists($this, $action)) {
            return (new Response())->withStatus(501);
        }

        return $this->$action($request);
    }

    public function getIndexAction(ServerRequestInterface $request): ResponseInterface
    {
        return new TextResponse('INDEX');
    }

    public function getAllAction(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            ['id' => 1, 'name' => 'car1'],
            ['id' => 2, 'name' => 'car2'],
        ]);
    }
}
