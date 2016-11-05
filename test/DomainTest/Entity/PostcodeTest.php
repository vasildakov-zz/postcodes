<?php
namespace DomainTest\Entity;

use Domain\Entity\Postcode;
use Domain\Entity\PostcodeInterface;

class PostcodeTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        //$this->router = $this->prophesize(RouterInterface::class);
    }

    /**
     * @dataProvider postcodeProvider
     */
    public function testCanBeConstructed($id, $postcode, $latitude, $longitude)
    {
        $entity = new Postcode($id, $postcode, $latitude, $longitude);

        self::assertInstanceOf(PostcodeInterface::class, $entity);
        self::assertEquals($postcode, $entity->getPostcode());
        self::assertEquals($latitude, $entity->getLatitude());
        self::assertEquals($longitude, $entity->getLongitude());
    }


    public function testCanBeEncodedToJson()
    {
        $entity = new Postcode(1, 'BB1 4LP', 53.771481090000000, -2.414392936000000);

        self::assertInternalType('array', $entity->jsonSerialize());

        self::assertInternalType('string', json_encode($entity));
    }

    /**
     * Returns an array with postcode
     * @return array
     */
    public function postcodeProvider()
    {
        return [
            [1, 'BB1 4LP', 53.771481090000000, -2.414392936000000],
            [2, 'YO8 5AD', 53.787594652483900, -1.059641311318670],
        ];
    }
}
