<?php
namespace Meling\Tests\Cart\Orders\Order;

class ActionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Actions
     */
    protected $actions;

    public function setUp()
    {
        $provider = \Meling\Tests\Cart\Providers\CustomerTest::getCustomer();
        $products = \Meling\Tests\Cart\Orders\Order\ProductsTest::getProducts();
        $this->actions = new \Meling\Cart\Orders\Order\Actions($provider, $products);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->actions);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->actions);
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
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions\Action', $this->actions->get());
    }

    public function testMethodGetAfter()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions\Action', $this->actions->getAfter(1));
    }

    public function testMethodGetAfterId()
    {
        foreach($this->actions->asAfter() as $action) {
            $this->assertInstanceOf(
                '\Meling\Cart\Orders\Order\Actions\Action', $this->actions->getAfter($action->id())
            );
            break;
        }
    }

    public function testMethodGetEmpty()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions\Action', $this->actions->get(1));
    }

    public function testMethodGetId()
    {
        $action = $this->actions->get();
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions\Action', $this->actions->get($action->id()));
    }

}
