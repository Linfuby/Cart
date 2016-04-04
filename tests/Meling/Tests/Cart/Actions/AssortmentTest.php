<?php
namespace Meling\Tests\Cart\Actions;

class AssortmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Actions\Assortment
     */
    protected $action;

    public function setUp()
    {
        $order        = \Meling\Tests\CartTest::getORM()->query('order')->in(472)->findOne(
            array(
                'customer.customerCards',
                'orderProducts.option.actionProducts',
            )
        );
        $provider     = new \Meling\Cart\Provider\Order($order);
        $products     = new \Meling\Cart\Products($provider);
        $cards        = new \Meling\Cart\Cards($order->customer()->customerCards()->asArray(true));
        $actions      = new \Meling\Cart\Actions($products, array(), $cards->getDefault());
        $this->action = new \Meling\Cart\Actions\Assortment($actions);
    }

    public function testAttributeCard()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Actions', 'actions', $this->action);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeEquals(null, 'entity', $this->action);
    }

    public function testMethodCalculate()
    {
        $this->assertEquals(0, $this->action->calculate());
    }

}
