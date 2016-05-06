<?php
namespace Meling\Tests\Cart;

class ActionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Actions
     */
    protected $actions;

    public function setUp()
    {
        $cart          = \Meling\Tests\CartTest::getCartCustomer();
        $this->actions = $cart->actions();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeActions()
    {
        $this->assertAttributeEquals(null, 'actions', $this->actions);
    }

    public function testAttributeActionsAfter()
    {
        $this->assertAttributeEquals(null, 'actionsAfter', $this->actions);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->actions);
    }

    public function testMethodAsAfter()
    {
        $this->assertInternalType('array', $this->actions->asAfter());
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->actions->asArray());
    }

    public function testMethodGet()
    {
        foreach($this->actions->asArray() as $action) {
            $this->assertInstanceOf('\Meling\Cart\Actions\Action', $this->actions->get($action->id()));
        }
    }

    public function testMethodGetAfterId()
    {
        foreach($this->actions->asAfter() as $action) {
            $this->assertInstanceOf('\Meling\Cart\Actions\Action', $this->actions->getAfter($action->id()));
        }
    }

    public function testMethodGetDefault()
    {
        $this->assertInstanceOf('\Meling\Cart\Actions\Action', $this->actions->get());
    }

}
