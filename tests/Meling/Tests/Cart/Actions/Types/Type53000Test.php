<?php
namespace Meling\Tests\Cart\Actions\Types;

class Type53000Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Actions\Types\Type53000
     */
    protected $type;

    public function setUp()
    {
        $cart       = \Meling\Tests\CartTest::getCustomerOptionsCart(array());
        $this->type = $cart->actions()->get()->type();
    }

    public function testAttributeTotals()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Totals', 'totals', $this->type);
    }

    public function testMethodNameEmpty()
    {
        $cart       = \Meling\Tests\CartTest::getCustomerOptionsCart();
        $this->type = $cart->actions()->get()->type();
        $this->assertEquals('Без Акции', $this->type->name());
    }

    public function testMethodTotal()
    {
        $this->assertEquals(0, $this->type->total());
    }

}
