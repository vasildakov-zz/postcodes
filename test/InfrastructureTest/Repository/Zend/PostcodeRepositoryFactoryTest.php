<?php

namespace InfrastructureTest\Repository\Zend;

use Interop\Container\ContainerInterface;

use Zend\Db\TableGateway\TableGatewayInterface;
#use Zend\Hydrator\HydratorInterface;
#use Zend\Db\Adapter\AdapterInterface;
#use Zend\Db\Sql\Sql;
#use Zend\Db\Sql\Select;

use Domain\Repository\PostcodeRepositoryInterface;
use Infrastructure\Repository\Zend\PostcodeRepository;
use Infrastructure\Repository\Zend\PostcodeRepositoryFactory;

class PostcodeRepositoryFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerInterface */
    protected $container;

    /** @var TableGatewayInterface */
    protected $tableGateway;


    protected function setUp()
    {
        $this->config = [
            'db' =>  [
                'driver'   => 'Mysqli',
                'database' => 'database',
                'username' => 'username',
                'password' => 'password',
                'dsn'      => 'mysql:dbname=database;host=localhost',
            ]
        ];

        $this->container = $this->prophesize(ContainerInterface::class);

        $this->tableGateway = $this->prophesize(TableGatewayInterface::class);

    }


    public function testCanBeConstructed()
    {
        $this->container->get('config')->willReturn($this->config);

        $factory = new PostcodeRepositoryFactory();

        $repository = $factory($this->container->reveal(), 'PostcodeRepository', null);

        $this->assertTrue($repository instanceof PostcodeRepositoryInterface);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Database is not configured
     */
    public function testItThrowsAnExceptionIfDatabaseIsNotConfigured()
    {
        $this->container->get('config')->willReturn([]);

        $factory = new PostcodeRepositoryFactory();

        $repository = $factory($this->container->reveal(), 'PostcodeRepository', null);
    }
}
