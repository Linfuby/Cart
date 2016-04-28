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
        /** @var \Meling\Tests\ORMWrappers\Entities\Customer $user */
        $user       = $orm->query('customer')->in(1)->findOne();
        $provider   = new \Meling\Cart\Providers\User($orm, $session, $user);
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
