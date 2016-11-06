<?php

namespace InfrastructureTest\Repository\Zend;

use Interop\Container\ContainerInterface;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

use Domain\Repository\PostcodeRepositoryInterface;
use Infrastructure\Repository\Zend\PostcodeRepository;

class PostcodeRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var TableGatewayInterface */
    protected $tableGateway;

    protected function setUp()
    {
        $this->tableGateway = $this->prophesize(TableGateway::class);
    }

    public function testCanBeConstructed()
    {
        $repository = new PostcodeRepository($this->tableGateway->reveal());

        $this->assertTrue($repository instanceof PostcodeRepositoryInterface);
    }


    /*public function testCanFindOneBy()
    {
        $postcode = "TW8 8FB";

        $select = $this->prophesize(Select::class)->reveal();

        $closure = function (Select $select) use ($postcode) {
            $select->columns(['id', 'postcode', 'latitude', 'longitude']);
            $select->where(['postcode = ?' => $postcode]);
            $select->limit(1);
        };

        //$this->tableGateway->select($this->anything())->shouldBeCalled();

        $this->tableGateway
             ->select($closure)
             ->will(function () use ($closure) {
                return $closure->__invoke();
             })
             ->shouldBeCalled()
        ;

        $repository = new PostcodeRepository($this->tableGateway->reveal());

        var_dump($repository->lookup('TW8 8FB'));
    } */



    public function testExample()
    {
        $resultSet = $this->getMockBuilder(ResultSet::class)->disableOriginalConstructor()->getMock();

        $tableGateway = $this->getMockBuilder(TableGateway::class)->disableOriginalConstructor()->getMock();

        $sql = $this->getMockBuilder(Sql::class)->disableOriginalConstructor()->getMock();

        $select = $this->getMockBuilder(Select::class)->disableOriginalConstructor()->getMock();


        $tableGateway
             ->expects($this->once())
             ->method('getSql')
             ->will($this->returnValue($sql))
        ;
        
        $tableGateway
             ->expects($this->once())
             ->method('selectWith')
             ->with($select)
             ->will($this->returnValue($resultSet))
        ;
        $sql
             ->expects($this->once())
             ->method('select')
             ->will($this->returnValue($select))
        ;

        $select
             ->expects($this->once())
             ->method('columns')
             ->with(['id', 'postcode', 'latitude', 'longitude'])
             ->will($this->returnSelf())
        ;

        $select
             ->expects($this->once())
             ->method('where')
             ->with(['postcode = ?' => 'TW8 8FB'])
             ->will($this->returnSelf())
        ;

        $repository = new PostcodeRepository($tableGateway);

        $resultSet = $repository->findOneByPostcode("TW8 8FB");

        $this->assertInstanceOf(ResultSet::class, $resultSet);

    }
}
