<?php

namespace App\Middleware\Postcode;

use App\Entity;
use VasilDakov\Postcode;

use Zend\Diactoros\Response\JsonResponse;
use Zend\Json\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Doctrine\ORM\EntityRepository;

class RandomAction
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
     * @param  RequestInterface  $request
     * @param  ResponseInterface $response
     * @param  callable|null     $next
     * @return [type]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $entity = $this->repository->random();

        if ($entity instanceof Entity\Postcode) {
            $postcode = new Postcode\Postcode($entity->getPostcode());

            $data = [
                'postcode' => $postcode->normalise(),
                'outcode'  => $postcode->outcode(),
                'incode'   => $postcode->incode(),
                'latitude' => (double)$entity->getLatitude(),
                'longitude'=> (double)$entity->getLongitude(),
            ];

            return new JsonResponse([
                'status' => 200, 'result' => $data
            ]);
        }

        return $next($request, $response);
    }
}
