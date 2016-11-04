<?php

namespace AppTest\Container\Zend\Db;

use Interop\Container\ContainerInterface;

class AdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        $config = [];

        $this->container = $this->prophesize(ContainerInterface::class);

        $this->container->get('config')->willReturn($config);
    }

    public function testAbc()
    {
        $this->assertEquals(1, 1);
    }
}
