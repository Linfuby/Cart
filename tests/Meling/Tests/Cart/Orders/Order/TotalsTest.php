<?php
namespace Meling\Tests\Cart\Orders\Order;

class TotalsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Totals
     */
    protected $totals;

    public function setUp()
    {
        $cart         = \Meling\Tests\CartTest::getCartCustomer();
        $this->totals = $cart->orders()->get()->totals();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->totals);
    }

}
