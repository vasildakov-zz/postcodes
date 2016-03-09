<?php

namespace App\Action;

use App\Entity;
use Doctrine\ORM\EntityManager;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostcodeAction
{
    /**
     * @var EntityManager $container
     */
    private $em;


    /**
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $em)
    {
        $this->em   = $em;
    }

    public function __invoke(
    	ServerRequestInterface $request, 
    	ResponseInterface $response, 
    	callable $next = null
    ) {
    	$postcode = $request->getQueryParams()['postcode'];

        $validator = new \App\Validator\PostCode;
        if(false === $validator->isValid($postcode)) {
            return new JsonResponse([
                'status' => 'error',
                'message' => $validator->getMessages()['error']
            ]);
        }

        $repository = $this->em->getRepository(Entity\Postcode::class);
        $entity = $repository->findOneBy(['postcode' => $postcode]);

        if($entity instanceof Entity\Postcode) {
            return new JsonResponse([
                'postcode'  => $entity->getPostcode(),
                'latitude'  => (float)$entity->getLatitude(),
                'longitude' => (float)$entity->getLongitude(),
            ]);
        }

        return $next($request, $response);
    }
}
