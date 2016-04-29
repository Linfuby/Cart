<?php
namespace Meling\Tests\Cart\Points\Tariffs;

class DeliveriesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Points\Tariffs\Deliveries
     */
    protected $deliveries;

    public function setUp()
    {
        $orm              = new \Meling\Tests\ORM();
        $option           = $orm->query('option')->in('-169235494')->findOne();
        $option           = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $certificate      = $orm->query('certificate')->in(3)->findOne();
        $certificate      = new \Meling\Cart\Providers\Product(1, $certificate, 3, 1500);
        $products         = array($option, $certificate);
        $products         = new \Meling\Cart\Products($products);
        $tariffs          = new \Meling\Cart\Points\Tariffs($products->asArray());
        $this->deliveries = new \Meling\Cart\Points\Tariffs\Deliveries($tariffs);
        $orm->disconnect();
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->deliveries->asArray());
    }

    public function testMethodGet()
    {
        $this->assertInstanceOf('\Meling\Cart\Points\Tariffs\Deliveries\Delivery', $this->deliveries->get(1));
    }

    /**
     * @expectedException \Exception
     */
    public function testMethodGetException()
    {
        $this->deliveries->asArray();
        $this->assertInstanceOf('\Meling\Cart\Points\Tariffs\Deliveries\Delivery', $this->deliveries->get(''));
    }

}
