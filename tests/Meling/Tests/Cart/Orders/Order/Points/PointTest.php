<?php
namespace Meling\Tests\Cart\Orders\Order\Points;

class PointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Points\Point
     */
    protected $point;

    public function setUp()
    {
        $cart        = \Meling\Tests\CartTest::getCartCustomer();
        $this->point = $cart->orders()->get()->products()->points()->get();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testMethodCity()
    {
        $this->assertInstanceOf('\Parishop\ORMWrappers\City\Entity', $this->point->city());
    }


}
