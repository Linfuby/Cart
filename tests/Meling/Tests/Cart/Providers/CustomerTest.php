<?php
namespace Meling\Tests\Cart\Providers;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    public static function getCustomer($id = null, $data = array())
    {
        $orm       = \Meling\Tests\CartTest::getORM();
        $source    = \Meling\Tests\Cart\SourceTest::getSource();
        $customers = $orm->query('customer');
        if($id) {
            $customers->in($id);
        }
        $customer = $customers->findOne();
        foreach($data as $key => $value) {
            $customer->setField($key, $value);
        }

        return new \Meling\Cart\Providers\Customer($source, $customer);
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getORM()->builder()->database()->connection('default')->disconnect();
    }

    public function testAttributeCustomer()
    {
        $customer = $this->getCustomer();
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'customer', $customer);
    }

    public function testAttributeSource()
    {
        $customer = $this->getCustomer();
        $this->assertAttributeInstanceOf('\Meling\Cart\Source', 'source', $customer);
    }

    public function testMethodCards()
    {
        $customer = $this->getCustomer();
        $this->assertInternalType('array', $customer->cards());
    }

    public function testMethodCertificates()
    {
        $customer = $this->getCustomer();
        $this->assertInternalType('array', $customer->certificates());
    }

    public function testMethodDateActual()
    {
        $customer = $this->getCustomer();
        $this->assertEquals(new \DateTime(), $customer->dateActual());
    }

    public function testMethodDateBirthday()
    {
        $customer = $this->getCustomer(null, array('birthday' => null));
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
        $customer = $this->getCustomer();
        $this->assertInternalType('string', $customer->id());
    }

    public function testMethodMagicGet()
    {
        $customer = $this->getCustomer();
        $this->assertInternalType('string', $customer->id);
    }

    public function testMethodProducts()
    {
        $customer = $this->getCustomer();
        $this->assertInternalType('array', $customer->products());
    }

}
