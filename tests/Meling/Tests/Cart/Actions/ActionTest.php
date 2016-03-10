<?php
namespace Meling\Tests\Cart\Actions;

class ActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Actions\Action
     */
    protected $action;

    public function setUp()
    {
        $subject      = \Meling\Tests\Cart\Providers\Subjects\CustomerTest::getSubject();
        $objects      = \Meling\Tests\Cart\Providers\Objects\ObjectTest::getObjectRepository();
        $products     = new\Meling\Cart\Products($subject, $objects);
        $totals       = new \Meling\Cart\Totals($products);
        $orm          = \Meling\Tests\CartTest::getORM();
        $action       = $orm->query('action')->findOne();
        $this->action = new \Meling\Cart\Actions\Action($totals, $action);
    }

    public function testAttributeAction()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->action);
    }

    public function testAttributeTotals()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Totals', 'totals', $this->action);
    }

}
