<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityRepository;
use Domain\Repository\PostcodeRepositoryInterface;

class PostcodeRepository extends EntityRepository implements PostcodeRepositoryInterface
{
    /**
     * @var string
     */
    protected $_entityName;

    /**
     * @var EntityManager
     */
    protected $_em;

    /**
     * @var \Doctrine\ORM\Mapping\ClassMetadata
     */
    protected $_class;

    /**
     * @param EntityManager         $em    The EntityManager to use.
     * @param Mapping\ClassMetadata $class The class descriptor.
     */
    public function __construct(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->_entityName = $class->name;
        $this->_em         = $em;
        $this->_class      = $class;
    }

    /**
     * Find one by postcode
     *
     * @param  string   $postcode
     * @return array
     */
    public function findOneByPostcode(string $postcode)
    {
        $dql = 'SELECT p FROM Domain\Entity\Postcode p WHERE p.postcode = ?1';
        $query = $em->createQuery($dql);
        $query->setParameter(1, $postcode);

        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }
}
