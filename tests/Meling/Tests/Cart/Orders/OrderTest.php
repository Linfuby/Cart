<?php
namespace Meling\Tests\Cart\Orders;

/**
 * Class OrderTest
 * @package Meling\Tests\Cart\Orders
 */
class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order
     */
    protected $order;

    public function setUp()
    {
        $cart        = \Meling\Tests\CartTest::getCartCustomer();
        $this->order = $cart->orders()->get();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeCertificates()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Certificates', 'certificates', $this->order);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(null, 'id', $this->order);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->order);
    }

}
