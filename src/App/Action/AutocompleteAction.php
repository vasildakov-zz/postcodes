<?php

namespace App\Action;

use Zend\Diactoros\Response\JsonResponse;
use Zend\Json\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Doctrine\ORM\EntityRepository;

class AutocompleteAction
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
     * @return callable $next
     */
    public function __invoke(
        RequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $data = [];

        $postcode = $request->getAttribute('postcode');
        $postcode = \preg_replace('/\s+/', '', \urldecode($postcode));

        $results = $this->repository->autocomplete($postcode, 25);
        if ($results) {
            foreach ($results as $entity) {
                $data[] = $entity->getPostcode();
            }

            return new JsonResponse([
                'status' => 200, 'result' => $data
            ]);
        }

        return $next($request, $response);
    }
}
