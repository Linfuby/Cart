<?php
namespace Meling\Tests\Cart\Providers;

/**
 * Class OrderTest
 * @package Meling\Tests\Cart\Providers
 */
class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Provider\Order
     */
    protected $order;

    public function setUp()
    {
        $orm = new \Meling\Tests\ORMStub();
        /** @var \Parishop\ORMWrappers\Order\Entity $order */
        $order       = $orm->query('order')->findOne();
        $this->order = new \Meling\Cart\Providers\Provider\Order($orm, $order, $order->cityId ? $order->cityId : -6194616, null);
    }

    public function testActions()
    {
        $this->order->order()->setField('created', '2015-05-01 09:00:00');
        $this->assertInstanceOf('Meling\Cart\Actions', $this->order->actions());
    }

    public function testActionsAfter()
    {
        $this->assertInstanceOf('Meling\Cart\Actions', $this->order->actionsAfter());
    }

    public function testActionsBirthday()
    {
        $this->order->customer()->setField('birthday', '1983-03-10');
        $this->order->customer()->setField('birthday_use', '0000-00-00');
        $this->assertInstanceOf('DateTime', $this->order->actionsBirthday());
    }

    public function testActionsBirthdayNull()
    {
        $this->order->customer()->setField('birthday', '0000-00-00');
        $this->order->customer()->setField('birthday_use', '0000-00-00');
        $this->assertNull($this->order->actionsBirthday());
    }

    public function testActionsBirthdayUse()
    {
        $this->order->customer()->setField('birthday', '1983-03-10');
        $this->order->customer()->setField('birthday_use', date('Y') . '-03-10');
        $this->assertNull($this->order->actionsBirthday());
    }

    public function testActionsBirthdayUseOld()
    {
        $this->order->customer()->setField('birthday', '1983-03-10');
        $this->order->customer()->setField('birthday_use', '1983-03-10');
        $this->assertInstanceOf('DateTime', $this->order->actionsBirthday());
    }

    public function testActionsDate()
    {
        $this->assertInstanceOf('DateTime', $this->order->actionsDate());
    }

    public function testActionsMarriage()
    {
        $this->order->customer()->setField('marriage', '2011-03-18');
        $this->order->customer()->setField('marriage_use', '0000-00-00');
        $this->assertInstanceOf('DateTime', $this->order->actionsMarriage());
    }

    public function testActionsMarriageNull()
    {
        $this->order->customer()->setField('marriage', '0000-00-00');
        $this->order->customer()->setField('marriage_use', '0000-00-00');
        $this->assertNull($this->order->actionsMarriage());
    }

    public function testActionsMarriageUse()
    {
        $this->order->customer()->setField('marriage', '2011-03-18');
        $this->order->customer()->setField('marriage_use', date('Y') . '-03-10');
        $this->assertNull($this->order->actionsMarriage());
    }

    public function testActionsMarriageUseOld()
    {
        $this->order->customer()->setField('marriage', '2011-03-18');
        $this->order->customer()->setField('marriage_use', '2011-03-18');
        $this->assertInstanceOf('DateTime', $this->order->actionsMarriage());
    }

    public function testAddresses()
    {
        $this->assertInstanceOf('Meling\Cart\Addresses', $this->order->addresses());
    }

    public function testAttributeOrm()
    {
        $this->assertAttributeInstanceOf('PHPixie\ORM', 'orm', $this->order);
    }

    public function testCards()
    {
        $this->assertInstanceOf('Meling\Cart\Cards', $this->order->cards());
    }

    public function testCity()
    {
        $this->assertInstanceOf('Parishop\ORMWrappers\City\Entity', $this->order->city());
    }

    public function testCityOther()
    {
        $this->assertInstanceOf('Parishop\ORMWrappers\City\Entity', $this->order->city('-6194616'));
    }

    public function testCustomer()
    {
        $this->assertInstanceOf('Parishop\ORMWrappers\Order\Entity', $this->order->order());
    }

    public function testEmail()
    {
        $this->order->order()->setField('email', 'web_dev@parisclub.ru');
        $this->assertEquals('web_dev@parisclub.ru', $this->order->email());
    }

    public function testFirstName()
    {
        $this->order->order()->setField('firstname', 'Вадим');
        $this->assertEquals('Вадим', $this->order->firstname());
    }

    public function testId()
    {
        $this->order->order()->setId(1);
        $this->assertEquals('1', $this->order->id());
    }

    public function testLastName()
    {
        $this->order->order()->setField('lastname', 'Мелинг');
        $this->assertEquals('Мелинг', $this->order->lastname());
    }

    public function testMiddleName()
    {
        $this->order->order()->setField('middlename', 'Александрович');
        $this->assertEquals('Александрович', $this->order->middlename());
    }

    public function testModels()
    {
        $this->assertInstanceOf('Meling\Cart\Providers\Models', $this->order->models());
    }

    public function testPhone()
    {
        $this->order->order()->setField('phone', '89096622608');
        $this->assertEquals('89096622608', $this->order->phone());
    }

    public function testProducts()
    {
        $this->assertInstanceOf('Meling\Cart\Products', $this->order->products());
    }


}
