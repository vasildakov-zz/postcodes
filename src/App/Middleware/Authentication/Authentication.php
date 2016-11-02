<?php

namespace App\Middleware\Authentication;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\EntityRepository;
use App\Entity;

class Authentication
{
    /**
     * @var EntityRepository $repository
     */
    private $repository;

    /**
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface      $response
     * @param  callable|null          $next
     * @return callable
     */
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        return $next($request, $response);

        /*
        $headers = [
            'Content-Type' => ['application/hal+json']
        ];

        if (!$request->hasHeader('Authorization')) {
            return new JsonResponse(
                ['status' => 401, 'error'  => 'Unauthorized'], 401, $headers
            );
        }

        $key = $request->getHeaderLine('Authorization');
        $entity = $this->repository->findOneBy(['key' => $key]);

        if(!$entity instanceof Entity\ApiKey) {
            return new JsonResponse(
                ['status' => 403, 'error'  => 'Forbidden'], 401, $headers
            );
        }

        return $next($request, $response); */
    }
}
