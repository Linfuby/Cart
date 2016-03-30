<?php
namespace Meling\Tests\Cart\Provider;

/**
 * Провайдер Покупателя
 * 1. Сущность
 * Class CustomerTest
 * @package Meling\Tests\Cart\Provider
 */
class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Provider\Customer
     */
    protected $provider;

    public function setUp()
    {
        /**
         * @var \Meling\Cart\Wrappers\Customer\Entity $customer
         */
        $customer = \Meling\Tests\CartTest::getORM()->query('customer')->in(1)->findOne(
            array(
                'cartCertificates',
                'cartCertificates.certificate',
                'cartProducts',
                'cartProducts.option',
                'customerRewards',
            )
        );
        \Meling\Tests\CartTest::getDatabase()->get()->disconnect();
        $this->provider = new \Meling\Cart\Provider\Customer($customer);
    }

    public function testAttributeOrder()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Wrappers\Customer\Entity', 'customer', $this->provider);
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
