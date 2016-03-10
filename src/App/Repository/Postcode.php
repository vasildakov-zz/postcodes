<?php
namespace App\Repository;

use App\Entity;
use Doctrine\ORM\EntityRepository;

class Postcode extends EntityRepository
{
    /**
     * Find one entity by postcode
     * @param  string $postcode
     * @return Postcode|null
     */
    public function findOneByPostcode($postcode)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('p')
           ->from(Entity\Postcode::class, 'p')
           ->where('p.postcode LIKE :postcode')
           ->setParameter('postcode', $postcode);

        return $qb->getQuery()->getOneOrNullResult();

    }
}
