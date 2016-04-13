<?php

namespace App\Action;

use App\Entity;
use VasilDakov\Postcode;
use Zend\InputFilter\InputFilter;
use Doctrine\ORM\EntityRepository;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

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
     * @param EntityRepository $repository
     * @param InputFilter      $filter
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
    public function __invoke(
        RequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ){
        $value = $request->getAttribute('postcode');
        $postcode = new Postcode\Postcode($value);

        $entity = $this->repository->findOneBy([
            'postcode' => $postcode->normalise()
        ]);

        if ($entity instanceof Entity\Postcode) {
            return new JsonResponse([
                'status' => 200,
                'data' => [
                    'postcode'  => $entity->getPostcode(),
                    'latitude'  => (double)$entity->getLatitude(),
                    'longitude' => (double)$entity->getLongitude(),
                    'incode'    => $postcode->incode(),
                    'outcode'   => $postcode->outcode(),
                ]
            ]);
        }

        return $next($request, $response);
    }
}
