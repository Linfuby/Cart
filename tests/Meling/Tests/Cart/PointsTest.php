<?php
namespace Meling\Tests\Cart;

class PointsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Points
     */
    protected $points;

    public function setUp()
    {
        $orm          = new \Meling\Tests\ORM();
        $option       = $orm->query('option')->in('-169235494')->findOne();
        $option       = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $certificate  = $orm->query('certificate')->in(3)->findOne();
        $certificate  = new \Meling\Cart\Providers\Product(1, $certificate, 3, 1500);
        $products     = array($option, $certificate);
        $products     = new \Meling\Cart\Products($products);
        $this->points = new \Meling\Cart\Points($products);
    }

    public function testMethodDeliveries()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Points\Deliveries', $this->points->deliveries(0));
    }

    public function testMethodShops()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Points\Shops', $this->points->shops(0));
    }

}
