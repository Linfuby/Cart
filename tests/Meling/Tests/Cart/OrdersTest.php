<?php
namespace Meling\Tests\Cart;

/**
 * Class OrdersTest
 * @package Meling\Tests\Cart
 */
class OrdersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders
     */
    protected $orders;

    public function setUp()
    {
        $context      = \Meling\Tests\Cart\ContextTest::getContextCustomer();
        $this->orders = new \Meling\Cart\Orders($context);
    }

    public function testAttributeContext()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Context', 'context', $this->orders);
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->orders->asArray());
    }

    public function testMethodGet()
    {
        foreach($this->orders->asArray() as $order) {
            $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->get($order->id()));
        }
    }

    public function testMethodGetDefault()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->get());
    }

    /**
     * @expectedException \Exception
     */
    public function testMethodGetException()
    {
        $this->orders->get(-1);
    }

}
