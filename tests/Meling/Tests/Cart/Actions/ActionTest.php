<?php
namespace Meling\Tests\Cart\Orders\Order\Actions;

class ActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Actions\Action
     */
    protected $action;

    public function setUp()
    {
        $cart         = \Meling\Tests\CartTest::getCartCustomer(null, array(), array(), 53001);
        $this->action = $cart->actions()->get();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeActionEntity()
    {
        $this->assertAttributeInstanceOf('\Parishop\ORMWrappers\Action\Entity', 'actionEntity', $this->action);
    }

    public function testAttributeCard()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Cards\Card', 'card', $this->action);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeEquals(array(), 'products', $this->action);
    }

    public function testMethodName()
    {
        $this->assertInternalType('string', $this->action->name());
    }

    public function testMethodTotalDiscount()
    {
        $this->assertEquals(0, $this->action->totalDiscount());
    }

    public function testMethodTotalType()
    {
        $this->assertInstanceOf('\Meling\Cart\Actions\Types\Type', $this->action->type());
    }

}
