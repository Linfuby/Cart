<?php
namespace Meling\Tests\Cart;

/**
 * Class ProductsTest
 * @package Meling\Tests\Cart
 */
class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    public function setUp()
    {
        $orm            = new \Meling\Tests\ORM();
        $option         = $orm->query('option')->in('-169235494')->findOne();
        $option         = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $certificate    = $orm->query('certificate')->in(3)->findOne();
        $certificate    = new \Meling\Cart\Providers\Product(1, $certificate, 3, 1500);
        $this->products = new \Meling\Cart\Products(array($option, $certificate));
        $orm->disconnect();
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInternalType('array', 'products', $this->products);
    }


}
