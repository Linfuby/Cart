<?php
namespace Meling\Tests\Cart\Orders\Order\Totals;

class BonusesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Totals\Bonuses
     */
    protected $totalsBonuses;

    public function setUp()
    {
        $orm                 = new \Meling\Tests\ORM();
        $actions             = $orm->query('allAction')->where('after', 1)->find(array('actionType'));
        $option              = $orm->query('option')->in('-169235494')->findOne();
        $option              = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $certificate         = $orm->query('certificate')->in(3)->findOne();
        $certificate         = new \Meling\Cart\Providers\Product(1, $certificate, 3, 1500);
        $products            = array($option, $certificate);
        $products            = new \Meling\Cart\Products($products);
        $this->totalsBonuses = new \Meling\Cart\Totals\Bonuses($actions->asArray(false, 'id'), $products->asArray());
    }

    public function testMethodName()
    {
        $this->assertEquals('Начислено бонусов', $this->totalsBonuses->name());
    }

    public function testMethodTotal()
    {
        $this->assertEquals(50, $this->totalsBonuses->total());
    }

}
