<?php

namespace App\Middleware\Authentication;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Doctrine\ORM\EntityRepository;

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


    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        if ($request->hasHeader('Authorization')) {
            $key = $request->getHeaderLine('Authorization');

            if($this->repository->findOneByKey($key)) {
                return $next($request, $response);
            }
        }

        $data = [
            'status' => 401,
            'error'  => 'Unauthorized'
        ];

        $headers = [
            'Content-Type' => ['application/hal+json']
        ];

        return new JsonResponse($data, 401, $headers);
    }
}
