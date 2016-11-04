<?php

namespace AppTest\Repository\Zend;

use Interop\Container\ContainerInterface;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

use App\Entity\PostcodeInterface;
use App\Repository\Zend\PostcodeRepository;

class PostcodeRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerInterface */
    protected $container;

    /** @var AdapterInterface */
    protected $adapter;

    /** @var HydratorInterface */
    protected $hydrator;

    /** @var PostcodeInterface */
    protected $entity;


    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->adapter   = $this->prophesize(AdapterInterface::class);
        $this->hydrator  = $this->prophesize(HydratorInterface::class);
        $this->entity    = $this->prophesize(PostcodeInterface::class);


        //$this->container->get(AdapterInterface::class)->willReturn($adapter);
        //$this->container->get(HydratorInterface::class)->willReturn($hydrator);
    }


    public function testCanBeConstructed()
    {
        $adapter  = $this->adapter->reveal();
        $hydrator = $this->hydrator->reveal();
        $entity   = $this->entity->reveal();

        $repository = new PostcodeRepository($adapter, $hydrator, $entity);
        $this->assertInstanceOf(PostcodeRepository::class, $repository);
    }

    public function testFunctionCanBeCalled()
    {
        $adapter  = $this->adapter->reveal();
        $hydrator = $this->hydrator->reveal();
        $entity   = $this->entity->reveal();

        $repository = new PostcodeRepository($adapter, $hydrator, $entity);

        $sql = $this->prophesize(Sql::class);
        $select = $this->prophesize(Select::class);

        $sql->select("TW8 8FB")->shouldBeCalled()->willReturn($select);

        //var_dump($repository->lookup("TW8 8FB"));
    }
}
