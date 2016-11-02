<?php

namespace App\Middleware\Postcode;

use App\Entity;
use VasilDakov\Postcode;
use Zend\InputFilter\InputFilter;
use Doctrine\ORM\EntityRepository;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

class LookupAction
{
    /**
     * @var EntityRepository $repository
     */
    private $repository;

    /**
     * @var InputFilter $filter
     */
    private $filter;


    /**
     * @TODO The validation input filter must be implemented as a middleware
     * @param EntityRepository      $repository
     * @param InputFilter           $filter
     */
    public function __construct(EntityRepository $repository, InputFilter $filter)
    {
        $this->repository = $repository;
        $this->filter     = $filter;
    }


    /**
     * @param  RequestInterface  $request
     * @param  ResponseInterface $response
     * @param  callable|null     $next
     * @return callable $next
     */
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $value = $request->getAttribute('postcode');
        $value = \preg_replace('/\s+/', '', \urldecode($value));

        $postcode = new Postcode\Postcode($value);

        $entity = $this->repository->findOneBy(
            [
                'postcode' => $postcode->normalise()
            ]
        );

        if ($entity instanceof Entity\Postcode) {
            return new JsonResponse([
                'status' => 200,
                'data' => [
                    'postcode'  => $entity->getPostcode(),
                    'outcode'   => $postcode->outcode(),
                    'incode'    => $postcode->incode(),
                    'latitude'  => (double)$entity->getLatitude(),
                    'longitude' => (double)$entity->getLongitude(),

                ]
            ],
            200, [
                "Access-Control-Allow-Origin" => "*",
                "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE"

            ]);
        }

        return $next($request, $response);
    }
}
