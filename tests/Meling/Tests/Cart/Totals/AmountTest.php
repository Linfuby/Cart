<?php
namespace Meling\Tests\Cart\Orders\Order\Totals;

class AmountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Totals\Amount
     */
    protected $totalsAmount;

    public function setUp()
    {
        $orm          = new \Meling\Tests\ORM();
        $option       = $orm->query('option')->in('-169235494')->findOne();
        $option       = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $certificate  = $orm->query('certificate')->in(3)->findOne();
        $certificate  = new \Meling\Cart\Providers\Product(1, $certificate, 3, 1500);
        $products     = array($option, $certificate);
        $products     = new \Meling\Cart\Products($products);
        $this->totalsAmount = new \Meling\Cart\Totals\Amount($products);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Products', 'products', $this->totalsAmount);
    }

    public function testMethodName()
    {
        $this->assertEquals('Сумма', $this->totalsAmount->name());
    }

    public function testMethodTotal()
    {
        $this->assertEquals(5500, $this->totalsAmount->total());
    }

}
