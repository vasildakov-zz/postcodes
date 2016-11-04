<?php

namespace App\Repository\Zend;

use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;

use App\Entity\Postcode;
use App\Repository\PostcodeRepositoryInterface;

class PostcodeRepository implements PostcodeRepositoryInterface
{
    /**
     * @param AdapterInterface  $adapter
     * @param HydratorInterface $hydrator
     * @param Postcode          $postcode
     */
    public function __construct(
        AdapterInterface $adapter,
        HydratorInterface $hydrator,
        Postcode $postcode
    ) {
        $this->adapter  = $adapter;
        $this->hydrator = $hydrator;
        $this->postcode = $postcode;
    }

    /**
     * lookup
     * @param  String $postcode
     * @return Postcode $postcode
     */
    public function lookup($postcode)
    {
        $sql = new Sql($this->adapter);

        $select = $sql->select('postcode');
        $select->where(['postcode = ?' => $postcode]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving postcode with identifier "%s"; unknown database error.',
                $postcode
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, new \App\Entity\Postcode);
        $resultSet->initialize($result);
        $postcode = $resultSet->current();

        return $postcode;

        // var_dump( $postcode); exit();


        /* return [
            'postcode'  => 'TW8 8FB',
            'outcode'   => 'TW8',
            'incode'    => '8FB',
            'latitude'  => 51.483954952877600,
            'longitude' => -0.312577856018865,
        ]; */
    }
}
