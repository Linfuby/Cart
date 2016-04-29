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
        $orm = new \Meling\Tests\ORM();
        /** @var \Meling\Tests\ORMWrappers\Entities\AllAction[] $actions */
        $actions       = $orm->query('allAction')->where('after', 0)->find(array('actionType'))->asArray(false, 'id');
        $this->actions = new \Meling\Cart\Actions($actions, '878770256001');
        $orm->disconnect();
    }

    public function testAttributeActionId()
    {
        $this->assertAttributeEquals('878770256001', 'actionId', $this->actions);
    }

    public function testAttributeActions()
    {
        $this->assertAttributeInternalType('array', 'actions', $this->actions);
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->actions->asArray());
    }

    public function testMethodGet()
    {
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\AllAction', $this->actions->get('878770256001'));
    }

    public function testMethodGetDefault()
    {
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\AllAction', $this->actions->getDefault());
    }

    /**
     * @expectedException \Exception
     */
    public function testMethodGetDefaultNull()
    {
        $this->actions = new \Meling\Cart\Actions(array());
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\AllAction', $this->actions->getDefault());
    }

    /**
     * @expectedException \Exception
     */
    public function testMethodGetException()
    {
        $this->assertInternalType('array', $this->actions->get(''));
    }

}
