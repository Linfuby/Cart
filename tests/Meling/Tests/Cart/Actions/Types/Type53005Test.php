<?php
namespace Meling\Tests\Cart\Orders\Order\Actions\Types;

class Type53005Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Actions\Types\Type
     */
    protected $type;

    /**
     * @var \Meling\Cart\Actions\Action
     */
    protected $action;

    public function setUp()
    {
        $cart   = \Meling\Tests\CartTest::getCartCustomer(null, array(), array(), 53005);
        $action = $cart->actions()->get();
        $action->setProducts($cart->orders()->get()->products()->asArray());
        $action->setTotals($cart->orders()->get()->totals());
        $this->type = $action->type();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeCard()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Cards\Card', 'card', $this->type);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInternalType('array', 'products', $this->type);
    }

    public function testMethodName()
    {
        $this->assertInternalType('string', $this->type->name());
    }

    public function testMethodTotal()
    {
        $this->assertInternalType('int', $this->type->total());
    }

}
