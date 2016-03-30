<?php
namespace Meling\Cart;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Customer
     */
    protected $customer;

    /**
     * @param mixed $id
     * @param array $data
     * @return Customer
     */
    public static function getCustomer($id, $data = array())
    {
        $orm = \Meling\CartTest::getORM();
        /**
         * @var \Meling\Cart\Wrappers\Customer\Entity $customer
         */
        $customer = $orm->query('customer')->in($id)->findOne(array('customerCards'));
        foreach($data as $name => $value) {
            $customer->setField($name, $value);
        }
        $cards = new \Meling\Cart\Cards($customer->customerCards()->asArray());

        return new \Meling\Cart\Customer($customer->id(), $customer->lastname, $customer->firstname, $customer->middlename, $customer->email, $customer->phone, $cards);
    }

    public static function getGuest()
    {
        $cards = new \Meling\Cart\Cards();

        return new \Meling\Cart\Customer(null, '', '', '', '', '', $cards);
    }

    public function setUp()
    {
        $this->customer = $this->getCustomer(1);
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeCards()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Cards', 'cards', $this->customer);
    }

    public function testAttributeEmail()
    {
        $this->assertAttributeInternalType('string', 'email', $this->customer);
    }

    public function testAttributeFirstName()
    {
        $this->assertAttributeInternalType('string', 'firstname', $this->customer);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->customer);
    }

    public function testAttributeLastName()
    {
        $this->assertAttributeInternalType('string', 'lastname', $this->customer);
    }

    public function testAttributeMiddleName()
    {
        $this->assertAttributeInternalType('string', 'middlename', $this->customer);
    }

    public function testAttributePhone()
    {
        $this->assertAttributeInternalType('string', 'phone', $this->customer);
    }

    public function testMethodCards()
    {
        $this->assertInstanceOf('\Meling\Cart\Cards', $this->customer->cards());
    }

    public function testMethodEmail()
    {
        $this->assertInternalType('string', $this->customer->email());
    }

    public function testMethodFirstName()
    {
        $this->assertInternalType('string', $this->customer->firstname());
    }

    public function testMethodFullName()
    {
        $this->assertInternalType('string', $this->customer->fullName());
    }

    public function testMethodId()
    {
        $this->assertEquals(1, $this->customer->id());
    }

    public function testMethodLastName()
    {
        $this->assertInternalType('string', $this->customer->lastname());
    }

    public function testMethodMiddleName()
    {
        $this->assertInternalType('string', $this->customer->middlename());
    }

    public function testMethodPhone()
    {
        $this->assertInternalType('string', $this->customer->phone());
    }

}
