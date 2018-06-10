<?php
declare(strict_types = 1);

namespace App\Handlers;

use App\Data\RepositoryInterface;
use App\Data\BuilderInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\TextResponse;
use Zend\Diactoros\Response\JsonResponse;
use Middlewares\HttpErrorException;

class CarsRequestHandler implements RequestHandlerInterface
{
    public function __construct(RepositoryInterface $repository, BuilderInterface $builder)
    {
        $this->repository = $repository;
        $this->builder = $builder;
    }

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
        $id = $request->getAttribute('id', null);

        if (isset($id)) {
            return new JsonResponse($this->repository->findById($id));
        }

        return new JsonResponse($this->repository->findAll());
    }

    public function postIndexAction(ServerRequestInterface $request): ResponseInterface
    {
        $json = $request->getBody()->__toString();
        
        try {
            $car = $this->builder->buildFromJsonString($json);
            return (new JsonResponse(
                $this->repository->add(
                    $car
                )
            ))->withStatus(201);
        } catch (HttpErrorException $e) {
            return (new Response())->withStatus($e->getCode());
        }        
    }

    public function deleteIndexAction(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id', '0');

        if (!isset($id) or $id === '0') {
            $response = new Response();
            $response->getBody()->write('Invalid `id`.');
            return $response
                ->withHeader('Content-type', 'text/plain')
                ->withStatus(400);
        }

        return new JsonResponse($this->repository->remove($id));
    }
}
