<?php
namespace Meling\Tests\Cart\Points;

class ShopsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Points\Shops
     */
    protected $shops;

    public function setUp()
    {
        $orm         = new \Meling\Tests\ORM();
        $option      = $orm->query('option')->in('-169235494')->findOne();
        $option      = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $certificate = $orm->query('certificate')->in(3)->findOne();
        $certificate = new \Meling\Cart\Providers\Product(1, $certificate, 3, 1500);
        $products    = array($option, $certificate);
        $products    = new \Meling\Cart\Products($products);
        $this->shops = new \Meling\Cart\Points\Shops($products);
        $orm->disconnect();
    }

    public function testMethodAsArrayProductId()
    {
        $orm         = new \Meling\Tests\ORM();
        $option      = $orm->query('option')->in('-169235494')->findOne();
        $option      = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $certificate = $orm->query('certificate')->in(3)->findOne();
        $certificate = new \Meling\Cart\Providers\Product(1, $certificate, 3, 1500);
        $products    = array($option, $certificate);
        $products    = new \Meling\Cart\Products($products);
        $this->shops = new \Meling\Cart\Points\Shops($products, 0);
        $orm->disconnect();
        $this->assertInternalType('array', $this->shops->asArray());
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->shops->asArray());

    }

    public function testMethodGet()
    {
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\Shop', $this->shops->get('-146541850'));
    }

    /**
     * @expectedException \Exception
     */
    public function testMethodException()
    {
        $this->shops->asArray();
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\Shop', $this->shops->get(0));
    }


}
