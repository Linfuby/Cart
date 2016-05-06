<?php
namespace Meling\Tests\Cart\Providers;

/**
 * Class CustomerTest
 * @package Meling\Tests\Cart\Providers
 */
class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Customer
     */
    protected $customer;

    public static function getCustomer($id = null, $data = array(), $session = array(), $actionTypeId = null)
    {
        $source    = \Meling\Tests\Cart\SourceTest::getSource($session, $actionTypeId);
        $customers = $source->query('customer');
        if($id) {
            $customers->in($id);
        }
        /**
         * @var \Parishop\ORMWrappers\Customer\Entity $customer
         */
        $customer = $customers->findOnePreload();
        foreach($data as $key => $value) {
            $customer->setField($key, $value);
        }

        return new \Meling\Cart\Providers\Customer($source, $customer);
    }

    public function setUp()
    {
        $cart           = \Meling\Tests\CartTest::getCartCustomer();
        $this->customer = $cart->builder()->context()->provider();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeCustomer()
    {
        $this->assertAttributeInstanceOf('\Parishop\ORMWrappers\Customer\Entity', 'customer', $this->customer);
    }

    public function testAttributeSource()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Source', 'source', $this->customer);
    }

    public function testMethodCards()
    {
        $this->assertInternalType('array', $this->customer->cards());
    }

    public function testMethodCertificates()
    {
        $this->assertInternalType('array', $this->customer->certificates());
    }

    public function testMethodDateActual()
    {
        $this->assertEquals(new \DateTime(), $this->customer->dateActual());
    }

    public function testMethodDateBirthday()
    {
        $customer = $this->getCustomer(1, array('birthday' => null));
        $this->assertNull($customer->dateBirthday());
        $customer = $this->getCustomer(null, array('birthday' => '0000-00-00'));
        $this->assertNull($customer->dateBirthday());
        $customer = $this->getCustomer(null, array('birthday' => '1983-03-10', 'birthday_use' => date('Y-m-d')));
        $this->assertNull($customer->dateBirthday());
        $customer = $this->getCustomer(null, array('birthday' => '1983-03-10', 'birthday_use' => null));
        $this->assertEquals(new \DateTime('1983-03-10'), $customer->dateBirthday());
        $customer = $this->getCustomer(null, array('birthday' => '1983-03-10', 'birthday_use' => '2015-03-10'));
        $this->assertEquals(new \DateTime('1983-03-10'), $customer->dateBirthday());
    }

    public function testMethodDateMarriage()
    {
        $customer = $this->getCustomer(null, array('marriage' => null));
        $this->assertNull($customer->dateMarriage());
        $customer = $this->getCustomer(null, array('marriage' => '0000-00-00'));
        $this->assertNull($customer->dateMarriage());
        $customer = $this->getCustomer(null, array('marriage' => '1983-03-10', 'marriage_use' => date('Y-m-d')));
        $this->assertNull($customer->dateMarriage());
        $customer = $this->getCustomer(null, array('marriage' => '1983-03-10', 'marriage_use' => null));
        $this->assertEquals(new \DateTime('1983-03-10'), $customer->dateMarriage());
        $customer = $this->getCustomer(null, array('marriage' => '1983-03-10', 'marriage_use' => '2015-03-10'));
        $this->assertEquals(new \DateTime('1983-03-10'), $customer->dateMarriage());
    }

    public function testMethodMagicCall()
    {
        $this->assertInternalType('string', $this->customer->name());
    }

    public function testMethodMagicGet()
    {
        $this->assertInternalType('string', $this->customer->id);
    }

    public function testMethodProducts()
    {
        $this->assertInternalType('array', $this->customer->products());
    }

}
