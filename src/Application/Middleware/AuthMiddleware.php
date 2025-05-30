<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use Exception;
use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthMiddleware implements MiddlewareInterface
{
    private ContainerInterface $container;
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory, ContainerInterface $container)
    {
        $this->responseFactory = $responseFactory;
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $response = $this->responseFactory->createResponse();

//        if ($request->getUri()->getPath() === '/api/user/enter') {
//            return $handler->handle($request);
//        }

        $token = str_replace("Bearer ", "", $request->getHeaderLine("Authorization"));

        if (!$token) {
            return $response->withStatus(401); // Unauthorized
        }

        try {
            $decoded = JWT::decode($token, 'your_secret_key', ['HS256']); // Replace with your secret key
            $this->container->set('jwt', $decoded);
            // Token is valid, continue to the next middleware/route
            return $handler->handle($request);
        } catch (Exception $e) {
            return $response->withStatus(400); // Bad Request
        }
    }
}
