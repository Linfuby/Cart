<?php
namespace Meling\Tests\Cart\Orders;

/**
 * Заказ
 * 1. Идентификатор
 * 2. Покупатель
 * 3. Товары
 * Class OrderTest
 * @package Meling\Cart\Orders
 */
class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order
     */
    protected $order;

    public function setUp()
    {
        /**
         * @var \Meling\Cart\Customer $customer
         * @var \Meling\Cart\Products $products
         */
        $customer    = $this->getMock('\Meling\Cart\Customer', array(), array(), '', false);
        $products    = $this->getMock('\Meling\Cart\Products', array(), array(), '', false);
        $this->order = new \Meling\Cart\Orders\Order(1, $customer, $products);
    }

    public function testAttributeCustomer()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Customer', 'customer', $this->order);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->order);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Products', 'products', $this->order);
    }

    public function testMethodAddCertificate()
    {
        /**
         * @var \Meling\Cart\Objects\Certificate $certificate
         */
        $certificate = $this->getMock('\Meling\Cart\Objects\Certificate', array(), array(), '', false);
        $this->assertEquals(0, $this->order->addCertificate($certificate));
    }

    public function testMethodAddOption()
    {
        /**
         * @var \Meling\Cart\Objects\Option $option
         */
        $option = $this->getMock('\Meling\Cart\Objects\Option', array(), array(), '', false);
        $this->assertEquals(0, $this->order->addOption($option));
    }

}
