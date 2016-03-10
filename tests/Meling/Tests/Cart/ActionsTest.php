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
        $environment = \Meling\Tests\Cart\Providers\Environments\EnvironmentTest::getEnvironment();
        $subject = \Meling\Tests\Cart\Providers\Subjects\CustomerTest::getSubject();
        $objects = \Meling\Tests\Cart\Providers\Objects\ObjectTest::getObjectRepository();
        $products = new \Meling\Cart\Products($subject, $objects);
        $totals = new \Meling\Cart\Totals($products);
        $this->actions = new \Meling\Cart\Actions($environment, $subject, $totals);
    }

    public function testAttributeEnvironment()
    {
        $this->assertAttributeInstanceOf(
            '\Meling\Cart\Providers\Environments\Environment', 'environment', $this->actions
        );
    }

    public function testMethodAsArray(){
        $this->assertInternalType('array', $this->actions->asArray());
    }

    public function testMethodAsAfter(){
        $this->assertInternalType('array', $this->actions->asAfter());
    }

    public function testMethodGet(){
        $this->actions->asArray();
        $this->assertInstanceOf('\Meling\Cart\Actions\Action', $this->actions->get());
    }

    public function testMethodGetAfter(){
        $this->actions->asAfter();
        $this->assertInstanceOf('\Meling\Cart\Actions\Action', $this->actions->getAfter(1));
    }

}
