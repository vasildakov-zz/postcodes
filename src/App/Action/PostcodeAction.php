<?php

namespace App\Action;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostcodeAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
    	$postcode = $request->getQueryParams()['postcode'];

        return new JsonResponse(['postcode' => $postcode]);
    }
}
