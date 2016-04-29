<?php
namespace Meling\Tests\Cart\Points;

class TariffsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Points\Tariffs
     */
    protected $tariffs;

    public function setUp()
    {
        $orm           = new \Meling\Tests\ORM();
        $option        = $orm->query('option')->in('-169235494')->findOne();
        $option        = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $certificate   = $orm->query('certificate')->in(3)->findOne();
        $certificate   = new \Meling\Cart\Providers\Product(1, $certificate, 3, 1500);
        $products      = array($option, $certificate);
        $products      = new \Meling\Cart\Products($products);
        $this->tariffs = new \Meling\Cart\Points\Tariffs($products->asArray());
        $orm->disconnect();
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->tariffs->asArray());

    }

    public function testMethodDeliveries()
    {
        $this->assertInstanceOf('\Meling\Cart\Points\Tariffs\Deliveries', $this->tariffs->deliveries());

    }

    /**
     * @expectedException \Exception
     */
    public function testMethodException()
    {
        $this->tariffs->asArray();
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\ShopTariff', $this->tariffs->get(0));
    }

    public function testMethodGet()
    {
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\ShopTariff', $this->tariffs->get(1));
    }

}
