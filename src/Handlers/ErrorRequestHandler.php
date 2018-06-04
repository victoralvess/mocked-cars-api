<?php
declare(strict_types = 1);

namespace App\Handlers;

use Middlewares\ErrorHandlerDefault;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ErrorRequestHandler extends ErrorHandlerDefault
{
    public function handle(Request $request): Response
    {
        $response = parent::handle($request);

        return $response;
    }
}
