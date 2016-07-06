<?php
namespace Meling\Tests\Cart\Providers;

/**
 * Class CustomerTest
 * @package Meling\Tests\Cart\Providers
 */
class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Provider\Customer
     */
    protected $customer;

    public function setUp()
    {
        $orm = new \Meling\Tests\ORMStub();
        /** @var \Parishop\ORMWrappers\Customer\Entity $customer */
        $customer       = $orm->query('customer')->findOne();
        $this->customer = new \Meling\Cart\Providers\Provider\Customer($orm, $customer, $customer->address() ? $customer->address()->cityId : -6194616, null);
    }

    public function testActions()
    {
        $this->assertInstanceOf('Meling\Cart\Actions', $this->customer->actions());
    }

    public function testActionsAfter()
    {
        $this->assertInstanceOf('Meling\Cart\Actions', $this->customer->actionsAfter());
    }

    public function testActionsBirthday()
    {
        $this->customer->customer()->setField('birthday', '1983-03-10');
        $this->customer->customer()->setField('birthday_use', '0000-00-00');
        $this->assertInstanceOf('DateTime', $this->customer->actionsBirthday());
    }

    public function testActionsBirthdayNull()
    {
        $this->customer->customer()->setField('birthday', '0000-00-00');
        $this->customer->customer()->setField('birthday_use', '0000-00-00');
        $this->assertNull($this->customer->actionsBirthday());
    }

    public function testActionsBirthdayUse()
    {
        $this->customer->customer()->setField('birthday', '1983-03-10');
        $this->customer->customer()->setField('birthday_use', date('Y') . '-03-10');
        $this->assertNull($this->customer->actionsBirthday());
    }

    public function testActionsBirthdayUseOld()
    {
        $this->customer->customer()->setField('birthday', '1983-03-10');
        $this->customer->customer()->setField('birthday_use', '1983-03-10');
        $this->assertInstanceOf('DateTime', $this->customer->actionsBirthday());
    }

    public function testActionsDate()
    {
        $this->assertInstanceOf('DateTime', $this->customer->actionsDate());
    }

    public function testActionsMarriage()
    {
        $this->customer->customer()->setField('marriage', '2011-03-18');
        $this->customer->customer()->setField('marriage_use', '0000-00-00');
        $this->assertInstanceOf('DateTime', $this->customer->actionsMarriage());
    }

    public function testActionsMarriageNull()
    {
        $this->customer->customer()->setField('marriage', '0000-00-00');
        $this->customer->customer()->setField('marriage_use', '0000-00-00');
        $this->assertNull($this->customer->actionsMarriage());
    }

    public function testActionsMarriageUse()
    {
        $this->customer->customer()->setField('marriage', '2011-03-18');
        $this->customer->customer()->setField('marriage_use', date('Y') . '-03-10');
        $this->assertNull($this->customer->actionsMarriage());
    }

    public function testActionsMarriageUseOld()
    {
        $this->customer->customer()->setField('marriage', '2011-03-18');
        $this->customer->customer()->setField('marriage_use', '2011-03-18');
        $this->assertInstanceOf('DateTime', $this->customer->actionsMarriage());
    }

    public function testAddresses()
    {
        $this->assertInstanceOf('Meling\Cart\Addresses', $this->customer->addresses());
    }

    public function testAttributeOrm()
    {
        $this->assertAttributeInstanceOf('PHPixie\ORM', 'orm', $this->customer);
    }

    public function testCards()
    {
        $this->assertInstanceOf('Meling\Cart\Cards', $this->customer->cards());
    }

    public function testCity()
    {
        $this->assertInstanceOf('Parishop\ORMWrappers\City\Entity', $this->customer->city());
    }

    public function testCustomer()
    {
        $this->assertInstanceOf('Parishop\ORMWrappers\Customer\Entity', $this->customer->customer());
    }

    public function testEmail()
    {
        $this->customer->customer()->setField('email', 'web_dev@parisclub.ru');
        $this->assertEquals('web_dev@parisclub.ru', $this->customer->email());
    }

    public function testFirstName()
    {
        $this->customer->customer()->setField('firstname', 'Вадим');
        $this->assertEquals('Вадим', $this->customer->firstname());
    }

    public function testId()
    {
        $this->customer->customer()->setId(1);
        $this->assertEquals('1', $this->customer->id());
    }

    public function testLastName()
    {
        $this->customer->customer()->setField('lastname', 'Мелинг');
        $this->assertEquals('Мелинг', $this->customer->lastname());
    }

    public function testMiddleName()
    {
        $this->customer->customer()->setField('middlename', 'Александрович');
        $this->assertEquals('Александрович', $this->customer->middlename());
    }

    public function testModels()
    {
        $this->assertInstanceOf('Meling\Cart\Providers\Models', $this->customer->models());
    }

    public function testPhone()
    {
        $this->customer->customer()->setField('phone', '89096622608');
        $this->assertEquals('89096622608', $this->customer->phone());
    }

    public function testProducts()
    {
        $this->assertInstanceOf('Meling\Cart\Products', $this->customer->products());
    }


}
