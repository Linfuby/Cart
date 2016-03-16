<?php
namespace Meling\Tests\Cart\Orders\Order;

class ShopsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Shops
     */
    protected $shops;

    public function setUp()
    {
        $products = \Meling\Tests\Cart\Orders\Order\ProductsTest::getProducts();
        $option   = \Meling\Tests\Cart\SourceTest::getSource()->query('option')->findOne();
        $products->add(array('customerId' => 1, 'option' => $option));
        $this->shops = new \Meling\Cart\Orders\Order\Shops($products->provider(), $products);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInternalType('array', 'shops', $this->shops);
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->shops->asArray());
    }

    public function testMethodGetDefault()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Shops\Shop', $this->shops->getDefault());
    }

}
