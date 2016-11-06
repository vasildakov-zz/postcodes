<?php

namespace Infrastructure\Repository\Zend;

use Zend\Db\TableGateway\TableGatewayInterface;

use Domain\Repository\PostcodeRepositoryInterface;

final class PostcodeRepository implements PostcodeRepositoryInterface
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;


    /**
     * Constructor
     *
     * @param TableGatewayInterface
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    /**
     * Find one by postcode
     *
     * @param  String   $postcode
     * @return Zend\Db\Sql\ResultSet
     */
    public function findOneByPostcode(string $postcode)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(['id', 'postcode', 'latitude', 'longitude']);
        $select->where(['postcode = ?' => $postcode]);

        return $this->tableGateway->selectWith($select);
    }
}
