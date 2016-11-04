<?php

namespace App\Repository\Zend;

use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;

use Zend\Db\TableGateway\TableGateway;

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
        $select = new Select();
        $select->from('postcode');
        $select->where(new Where());
        $select->columns(array('postcode'));
        $select->limit(1);
        $rowset = $this->gateway->select($select);
        */

        $rowset = $this->gateway->select(['postcode' => $postcode]);
        //var_dump($rowset->current()); exit();
        return $rowset->current();
    }




    public function findUsingSql()
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

        $resultSet = new HydratingResultSet($this->hydrator, $this->postcode);
        $resultSet->initialize($result);
        $postcode = $resultSet->current();

        return $postcode;
    }
}
