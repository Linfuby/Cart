<?php
namespace Meling\Tests\Cart\Orders\Order\Actions;

class ActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Actions\Action
     */
    protected $action;

    public function setUp()
    {
        $products     = \Meling\Tests\Cart\Orders\Order\ProductsTest::getProducts();
        $card         = \Meling\Tests\Cart\Orders\Order\Actions\Cards\CardTest::getCard();
        $action       = \Meling\Tests\Cart\SourceTest::getSource()->query('action')->findOne();
        $this->action = new \Meling\Cart\Orders\Order\Actions\Action($products, $action, $card);
    }

    public function testAttributeAction()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Models\Type\Database\Entity', 'action', $this->action);
    }

    public function testAttributeCard()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Actions\Cards\Card', 'card', $this->action);
    }

    public function testAttributeTotals()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->action);
    }

    public function testMethodName()
    {
        $this->assertInternalType('string', $this->action->name);
    }

    public function testMethodTotalDiscount()
    {
        $this->assertEquals(0, $this->action->totalDiscount());
    }

    public function testMethodTotalType()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions\Types\Type', $this->action->type());
    }

    public function testMethodTotalTypeEmpty()
    {
        $products     = \Meling\Tests\Cart\Orders\Order\ProductsTest::getProducts();
        $card         = \Meling\Tests\Cart\Orders\Order\Actions\Cards\CardTest::getCard();
        $this->action = new \Meling\Cart\Orders\Order\Actions\Action($products, null, $card);
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions\Types\Type', $this->action->type());
    }

    public function testMethodTotalTypeIncorrect()
    {
        $products = \Meling\Tests\Cart\Orders\Order\ProductsTest::getProducts();
        $card     = \Meling\Tests\Cart\Orders\Order\Actions\Cards\CardTest::getCard();
        $action   = \Meling\Tests\Cart\SourceTest::getSource()->query('action')->findOne();
        $action->setField('actionTypeId', 53);
        $this->action = new \Meling\Cart\Orders\Order\Actions\Action($products, $action, $card);
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions\Types\Type', $this->action->type());
    }
}
