<?php
namespace App\Repository;

use App\Entity;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

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
           ->setParameter('postcode', '%'.$postcode.'%');

        return $qb->getQuery()->getOneOrNullResult();

    }

    /**
     * Find one entity by postcode
     * @param  string $postcode
     * @return Postcode|null
     */
    public function autocomplete($postcode, $limit = 25)
    {
        $qb = $this->_em->createQueryBuilder();

        $rsm = new ResultSetMapping();

        $rsm->addEntityResult(Entity\Postcode::class, 'p');

        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'postcode', 'postcode');
        $rsm->addFieldResult('p', 'latitude', 'latitude');
        $rsm->addFieldResult('p', 'longitude', 'longitude');

        $sql = "SELECT id, postcode, latitude, longitude
                FROM postcode
                WHERE REPLACE(postcode, ' ', '')
                LIKE ?
                ORDER BY postcode ASC
                LIMIT ? ";

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $postcode.'%');
        $query->setParameter(2, $limit);

        return $query->getResult();
    }


    /**
     * Returns random postcode
     * @return [type] [description]
     */
    public function random()
    {
        $amount = 1;

        $rows = $this->_em->createQuery('SELECT COUNT(p.id) FROM App\\Entity\\Postcode p')
                          ->getSingleScalarResult();

        $offset = max(0, rand(0, $rows - $amount - 1));

        $query = $this->_em->createQuery('SELECT DISTINCT p FROM App\\Entity\\Postcode p')
                           ->setMaxResults($amount)
                           ->setFirstResult($offset);

        return $query->getSingleResult();
    }
}
