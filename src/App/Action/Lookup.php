<?php

namespace App\Action;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Repository\PostcodeRepositoryInterface;

class Lookup
{
    public function __construct(PostcodeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $postcode = $request->getAttribute('postcode');

        $data = $this->repository->lookup($postcode);

        return new JsonResponse([
            'status' => 200,
            'data' => $data,
        ], 200, [
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE"
        ]);
    }
}
