<?php

namespace App\Repository\Zend;

use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;

use Zend\Hydrator\Reflection as ReflectionHydrator;

use App\Entity\Postcode;
use App\Entity\PostcodeInterface;
use App\Repository\PostcodeRepositoryInterface;

final class PostcodeRepository implements PostcodeRepositoryInterface
{
    /**
     * Constructor
     *
     * @param TableGateway
     */
    public function __construct(TableGateway $gateway)
    {
        $this->gateway = $gateway;
    }


    /**
     * Find one by postcode
     *
     * @param  String   $postcode
     * @return Postcode $postcode
     */
    public function lookup(string $postcode)
    {
        /*
        adapter = $this->gateway->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select('postcode');
        $select->columns(['id', 'postcode']);
        $select->where(['postcode = ?' => $postcode]);
        $select->limit(1);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        var_dump($result->current());
        exit();
        */

        $resultSet = $this->gateway->select(function (Select $select) use ($postcode) {
            $select->columns(['id', 'postcode', 'latitude', 'longitude']);
            $select->where(['postcode = ?' => $postcode]);
            $select->limit(1);
        });

        $row = $resultSet->current();

        return (!$row) ? null : $row;
    }




    /*public function findUsingSql()
    {
        $adapter = $this->gateway->getAdapter();

        $sql = new Sql($adapter);

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

        $resultSet = new HydratingResultSet(new ReflectionHydrator, new Postcode);
        $resultSet->initialize($result);
        $postcode = $resultSet->current();

        var_dump($postcode);
        exit();
    }*/



    /* public function paginator()
    {
        $sql = "
            SELECT id, postcode 
            FROM postcode 
            WHERE postcode LIKE 'TW8%' 
            ORDER BY postcode ASC 
            LIMIT 10000"
        ;

        $connection = $this->gateway->getAdapter()->getDriver()->getConnection();
        $results = $connection->execute($sql);

        $iteratorAdapter = new \Zend\Paginator\Adapter\Iterator($results);
        $paginator = new \Zend\Paginator\Paginator($iteratorAdapter);

        $items = $paginator->getIterator();
        foreach ($items as $item) {
            var_dump($item);
        }
        exit();
    } */
}
