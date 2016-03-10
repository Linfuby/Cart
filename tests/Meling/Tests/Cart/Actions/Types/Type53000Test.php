<?php
namespace Meling\Tests\Cart\Actions\Types;

class Type53000Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Actions\Types\Type53000
     */
    protected $type;

    /**
     * @var \Meling\Cart\Totals
     */
    protected $totals;

    public function setUp()
    {

        $products     = new \Meling\Cart\Products(
            \Meling\Tests\Cart\Providers\Subjects\CustomerTest::getSubject(),
            \Meling\Tests\Cart\Providers\Objects\ObjectTest::getObjectRepository(
                'cart', 'customerId', \Meling\Tests\Cart\Providers\Subjects\CustomerTest::getCustomer()->id()
            )
        );
        $this->totals = new \Meling\Cart\Totals($products);
        $this->type   = new \Meling\Cart\Actions\Types\Type53000($this->totals, $action = null);
    }

    public function testAttributeTotals()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Totals', 'totals', $this->type);
    }

    public function testMethodName()
    {
        $orm        = \Meling\Tests\CartTest::getORM();
        $action     = $orm->query('action')->findOne();
        $this->type = new \Meling\Cart\Actions\Types\Type53000($this->totals, $action);
        $this->assertEquals($action->getField('name'), $this->type->name());
    }

    public function testMethodNameEmpty()
    {
        $this->assertEquals('Без Акции', $this->type->name());
    }

    public function testMethodTotal()
    {
        $this->assertEquals(0, $this->type->total());
    }

}
