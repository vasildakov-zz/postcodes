<?php

namespace AppTest\Middleware\Authentication;

use App\Middleware\Authentication\Authentication;

use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router\RouterInterface;

class AuthenticationTest extends \PHPUnit_Framework_TestCase
{
    /** @var RouterInterface */
    protected $router;

    /**
     * @var string $poscode
     */
    protected $postcode;

    /**
     * @var string $key
     */
    protected $key;

    protected function setUp()
    {
        $this->router   = $this->prophesize(RouterInterface::class);
        $this->postcode = 'TW88FB';
        $this->key      = '3458fb4d-30e0-54b5-9be8-5bace6b37c93';
    }

    public function testUnauthorizedResponse()
    {

        $args = [[], [], '/api/postcodes/TW88FB', 'GET', 'php://input', ['Authorization' => 'aa']];

        /** @var \PHPUnit_Framework_MockObject_MockObject|\Zend\Diactoros\Response $response */
        $response = $this->getMockBuilder(\Zend\Diactoros\Response::class)
             ->disableOriginalConstructor()
             ->getMock()
        ;

        /** @var \PHPUnit_Framework_MockObject_MockObject|\App\Entity\ApiKey $apikey */
        $apikey = $this->getMockBuilder(\App\Entity\ApiKey::class)
             ->disableOriginalConstructor()
             ->getMock()
        ;

        /** @var \PHPUnit_Framework_MockObject_MockObject|\Zend\Diactoros\ServerRequest $request */
        $request = $this->getMockBuilder(\Zend\Diactoros\ServerRequest::class)
             ->setConstructorArgs($args)
             ->getMock()
        ;

        $request
            ->expects($this->once())
            ->method('hasHeader')
            ->with('Authorization')
            ->will($this->returnValue(true))
        ;

        $request
            ->expects($this->once())
            ->method('getHeaderLine')
            ->will($this->returnValue($this->key))
        ;

        /** @var \PHPUnit_Framework_MockObject_MockObject|\Doctrine\ORM\EntityRepository $repository */
        $repository = $this->getMockBuilder(\Doctrine\ORM\EntityRepository::class)
             ->disableOriginalConstructor()
             ->getMock()
        ;

        $repository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['key' => $this->key])
            ->will($this->returnValue($apikey))
        ;

        $authentication = new Authentication($repository);

        $response = $authentication($request, $response, function () {
        });

        $json = json_decode((string) $response->getBody());

        $this->assertTrue($response instanceof Response);
        $this->assertTrue($response instanceof Response\JsonResponse);

        $this->assertTrue(isset($json->status));
        $this->assertTrue(isset($json->error));

        $this->assertEquals(401, $json->status);
        $this->assertEquals('Unauthorized', $json->error);

        //var_dump($json);
    }


    public function testWithInvalidApiKey()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|\Doctrine\ORM\EntityRepository $repository */
        $repository = $this->getMockBuilder(\Doctrine\ORM\EntityRepository::class)
             ->disableOriginalConstructor()
             ->getMock()
        ;

        $authentication = new Authentication($repository);

    }
}
