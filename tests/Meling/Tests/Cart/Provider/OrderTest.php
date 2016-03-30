<?php
namespace Meling\Tests\Cart\Provider;

/**
 * Провайдер Заказа
 * 1. Сущность
 * Class OrderTest
 * @package Meling\Tests\Cart\Provider
 */
class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Provider\Order
     */
    protected $provider;

    public function setUp()
    {
        /**
         * @var \Meling\Cart\Wrappers\Order\Entity $order
         */
        $order = \Meling\Tests\CartTest::getORM()->query('order')->in(1)->findOne(
            array(
                'orderCertificates',
                'orderCertificates.certificate',
                'orderProducts',
                'orderProducts.option',
            )
        );
        \Meling\Tests\CartTest::getDatabase()->get()->disconnect();
        $this->provider = new \Meling\Cart\Provider\Order($order);
    }

    public function testAttributeOrder()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Wrappers\Order\Entity', 'order', $this->provider);
    }

    public function testMethodObjects()
    {
        $this->assertInstanceOf('\Meling\Cart\Objects', $this->provider->objects());
    }

    public function testMethodRewards()
    {
        $this->assertInternalType('int', $this->provider->rewards());
    }

}
