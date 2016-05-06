<?php
namespace Meling\Tests\Cart\Orders\Order;

class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Products
     */
    protected $products;

    public function setUp()
    {
        $cart           = \Meling\Tests\CartTest::getCartCustomer();
        $this->products = $cart->orders()->get()->products();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInternalType('array', 'products', $this->products);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->products);
    }

}
