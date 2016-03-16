<?php

namespace App\Action;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

use VasilDakov\Postcode\Postcode;

class ValidateAction
{
    public function __invoke(
        RequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
    	$value = $request->getAttribute('postcode');
        $value = \preg_replace('/\s+/', '', \urldecode($value));

        $postcode = new Postcode($value);

    	if($postcode->valid()) {
            $postcode = new Postcode($value);
            return new JsonResponse([
                'status' => 200,
                'result' => true
            ]);
    	}

        return new JsonResponse([
            'status' => 404,
            'error' => "Postcode not found"
        ]);
    }
}
