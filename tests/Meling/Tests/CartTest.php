<?php
namespace Meling\Tests;

class CartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart
     */
    protected $cart;

    public function setUp()
    {
        $orm     = new \Meling\Tests\ORM();
        $session = new \Meling\Tests\Session();
        /** @var \Parishop\ORMWrappers\Customer\Entity $user */
        $user = $orm->query('customer')->in(1)->findOne();
        /** @var \Parishop\ORMWrappers\City\Entity $city */
        $city       = $orm->query('city')->where('name', 'Москва')->findOne();
        $provider   = new \Meling\Cart\Providers\User($orm, $session, $city, $user);
        $this->cart = new \Meling\Cart($provider);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->cart);
        $this->cart->provider()->orm()->disconnect();
    }

    public function testMethodProducts()
    {
        $this->assertInstanceOf('\Meling\Cart\Products', $this->cart->products());
        $this->cart->provider()->orm()->disconnect();
    }

    public function testMethodProvider()
    {
        $this->assertInstanceOf('\Meling\Cart\Providers\Provider', $this->cart->provider());
        $this->cart->provider()->orm()->disconnect();
    }

}
