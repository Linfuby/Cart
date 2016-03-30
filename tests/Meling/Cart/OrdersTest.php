<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 29.03.2016
 * Time: 16:36
 */

namespace Meling\Cart;

class OrdersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders
     */
    protected $orders;

    public function setUp()
    {
        $customer     = \Meling\Cart\CustomerTest::getCustomer(1);
        $provider     = \Meling\Cart\Provider\CustomTest::getProvider(
            array(
                (object)array(
                    'id'           => 1,
                    'option'       => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => 1,
                    'deliveryId'   => null,
                    'shopTariffId' => null,
                    'addressId'    => null,
                ),
                (object)array(
                    'id'           => 1,
                    'option'       => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => 1,
                    'deliveryId'   => 2,
                    'shopTariffId' => 2,
                    'addressId'    => 2,
                ),
            ), array(
                (object)array(
                    'id'           => 1,
                    'certificate'  => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => 1,
                    'deliveryId'   => null,
                    'shopTariffId' => null,
                    'addressId'    => null,
                ),
                (object)array(
                    'id'           => 1,
                    'certificate'  => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => 1,
                    'deliveryId'   => 2,
                    'shopTariffId' => 2,
                    'addressId'    => 2,
                ),
            )
        );
        $this->orders = new \Meling\Cart\Orders($customer, $provider);
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeCustomer()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Customer', 'customer', $this->orders);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Provider\Custom', 'provider', $this->orders);
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->orders->asArray());
    }

    public function testMethodDefaultOrder()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->defaultOrder());
    }

    public function testMethodGet()
    {
        $this->orders->asArray();
        $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->get(0));
    }

    /**
     * @expectedException \Exception
     */
    public function testMethodGetThrow()
    {
        $this->orders->asArray();
        $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->get(null));
    }

}
