<?php

namespace App\Action;

use App\Entity;
use Zend\InputFilter\InputFilter;
use Doctrine\ORM\EntityRepository;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

class PostcodeAction
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
     * @return $next
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $params = $request->getQueryParams();

        $this->filter->setData($params);
        if(!$this->filter->isValid()) {
            return new JsonResponse([
                'status' => 'error',
                'messages' => $this->filter->getMessages()
            ]);
        }

        $postcode = $this->filter->getValue('postcode');
        $entity = $this->repository->findOneByPostcode($postcode);

        if($entity instanceof Entity\Postcode) {
            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'postcode'  => $entity->getPostcode(),
                    'latitude'  => (float)$entity->getLatitude(),
                    'longitude' => (float)$entity->getLongitude(),
                ]
            ]);
        }

        return $next($request, $response);
    }
}
