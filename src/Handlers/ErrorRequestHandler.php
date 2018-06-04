<?php
declare(strict_types = 1);

namespace App\Handlers;

use Middlewares\ErrorHandlerDefault;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Diactoros\Response\HtmlResponse;

class ErrorRequestHandler extends ErrorHandlerDefault
{
    public function __construct() {
        $root = dirname(__DIR__, 2);
        $loader = new \Twig_Loader_Filesystem($root . '/templates');
        $this->twig = new \Twig_Environment($loader);
    }

    public function handle(Request $request): Response
    {
        $response = parent::handle($request);

        if ($response->getHeaderLine('Content-Type') === 'text/html') {
            $html = $this->twig->render('error.html', [ 'error' => $request->getAttribute('error') ]);
            $response = new HtmlResponse($html, $response->getStatusCode(), $response->getHeaders());    
        }

        return $response;
    }
}
