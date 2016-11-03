<?php

namespace App\Middleware\Postcode;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

use VasilDakov\Postcode\Postcode;

class ValidateAction
{
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $value = $request->getAttribute('postcode');
        $value = \preg_replace('/\s+/', '', \urldecode($value));

        $postcode = new Postcode($value);
        if ($postcode->valid()) {
            return new JsonResponse([
                'status' => 200,
                'result' => true
            ]);
        }

        return $next($request, $response);
    }
}
