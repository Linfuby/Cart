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
        $orm        = new ORMStub();
        $array      = array();
        $session    = new SAPIStub($array);
        $provider   = new \Meling\Cart\Providers\Provider\Session($orm, $session, -6194616, null);
        $this->cart = new \Meling\Cart($provider);
    }

    public function test()
    {
        $this->assertInstanceOf('Meling\Cart\Products', $this->cart->products());
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('Meling\Cart\Providers\Provider', 'provider', $this->cart);
    }


}
