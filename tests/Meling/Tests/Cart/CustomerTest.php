<?php
namespace Meling\Tests\Cart;

/**
 * Покупатель
 * Class CustomerTest
 * @package Meling\Tests\Cart
 */
class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Customer
     */
    protected $customer;


    public function setUp()
    {
        $cards          = new \Meling\Cart\Cards();
        $this->customer = new \Meling\Cart\Customer(1, 'Фамилия', 'Имя', 'Отчество', 'E-mail', 'Телефон', $cards);
    }

    public function testAttributeCards()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Cards', 'cards', $this->customer);
    }

    public function testAttributeEmail()
    {
        $this->assertAttributeEquals('E-mail', 'email', $this->customer);
    }

    public function testAttributeFirstName()
    {
        $this->assertAttributeEquals('Имя', 'firstname', $this->customer);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->customer);
    }

    public function testAttributeLastName()
    {
        $this->assertAttributeEquals('Фамилия', 'lastname', $this->customer);
    }

    public function testAttributeMiddleName()
    {
        $this->assertAttributeEquals('Отчество', 'middlename', $this->customer);
    }

    public function testAttributePhone()
    {
        $this->assertAttributeEquals('Телефон', 'phone', $this->customer);
    }

    public function testMethodCards()
    {
        $this->assertInstanceOf('\Meling\Cart\Cards', $this->customer->cards());
    }

    public function testMethodEmail()
    {
        $this->assertEquals('E-mail', $this->customer->email());
    }

    public function testMethodFirstName()
    {
        $this->assertEquals('Имя', $this->customer->firstname());
    }

    public function testMethodFullName()
    {
        $this->assertEquals('Фамилия Имя Отчество', $this->customer->fullName());
    }

    public function testMethodId()
    {
        $this->assertEquals(1, $this->customer->id());
    }

    public function testMethodLastName()
    {
        $this->assertEquals('Фамилия', $this->customer->lastname());
    }

    public function testMethodMiddleName()
    {
        $this->assertEquals('Отчество', $this->customer->middlename());
    }

    public function testMethodPhone()
    {
        $this->assertEquals('Телефон', $this->customer->phone());
    }

}
