<?php
namespace Meling\Tests\Cart\Providers;

/**
 * Class SubjectTest
 * @package Meling\Tests\Cart\Providers\Subjects
 */
class SubjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Subjects\Customer
     */
    protected $customer;

    /**
     * @var \Meling\Cart\Providers\Subjects\Order
     */
    protected $order;

    /**
     * @var \Meling\Cart\Providers\Subjects\Session
     */
    protected $session;

    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    public function setUp()
    {
        $this->orm      = \Meling\Tests\CartTest::getORM();
        $this->customer = \Meling\Tests\Cart\Providers\Subjects\CustomerTest::getSubject();
        $this->order    = \Meling\Tests\Cart\Providers\Subjects\OrderTest::getSubject();
        $this->session  = \Meling\Tests\Cart\Providers\Subjects\SessionTest::getSubject();
    }

    public function testAttributeSubject()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'subject', $this->customer);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'subject', $this->order);
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session\SAPI', 'subject', $this->session);
    }

    public function testMethodCards()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Loaders\Loader\Proxy\Editable', $this->customer->cards());
        $this->assertInstanceOf('\PHPixie\ORM\Loaders\Loader\Proxy\Editable', $this->order->cards());
        $this->assertEquals(array(), $this->session->cards());
    }

    public function testMethodDateActual()
    {
        $this->assertInstanceOf('\DateTime', $this->customer->dateActual());
        $this->assertInstanceOf('\DateTime', $this->order->dateActual());
        $this->assertInstanceOf('\DateTime', $this->session->dateActual());
    }

    public function testMethodDateBirthday()
    {
        $this->assertInstanceOf('\DateTime', $this->customer->dateBirthday());
        $this->assertInstanceOf('\DateTime', $this->order->dateBirthday());
        $this->assertNull($this->session->dateBirthday());
    }

    public function testMethodDateBirthdayNull()
    {
        /**
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $customer
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $order
         */
        $customer = $this->orm->query('customer')->findOne();
        $customer->setField('birthday', null);
        $this->customer = new \Meling\Cart\Providers\Subjects\Customer($customer, $this->orm->repositories());
        $order          = $this->orm->query('order')->findOne();
        $order->customer()->setField('birthday', null);
        $this->order = new \Meling\Cart\Providers\Subjects\Order($order, $this->orm->repositories());
        $this->assertNull($this->customer->dateBirthday());
        $this->assertNull($this->order->dateBirthday());
        $this->assertNull($this->session->dateBirthday());
    }

    public function testMethodDateBirthdayUse()
    {
        /**
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $customer
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $order
         */
        $customer = $this->orm->query('customer')->findOne();
        $customer->setField('birthday', date('Y-m-d'));
        $customer->setField('birthday_use', date('Y-m-d'));
        $this->customer = new \Meling\Cart\Providers\Subjects\Customer($customer, $this->orm->repositories());
        $order          = $this->orm->query('order')->findOne();
        $order->customer()->setField('birthday', date('Y-m-d'));
        $order->customer()->setField('birthday_use', date('Y-m-d'));
        $this->order = new \Meling\Cart\Providers\Subjects\Order($order, $this->orm->repositories());
        $this->assertNull($this->customer->dateBirthday());
        $this->assertNull($this->order->dateBirthday());
        $this->assertNull($this->session->dateBirthday());
    }

    public function testMethodDateBirthdayUseNot()
    {
        /**
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $customer
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $order
         */
        $customer = $this->orm->query('customer')->findOne();
        $customer->setField('birthday', date('Y-m-d'));
        $customer->setField('birthday_use', null);
        $this->customer = new \Meling\Cart\Providers\Subjects\Customer($customer, $this->orm->repositories());
        $order          = $this->orm->query('order')->findOne();
        $order->customer()->setField('birthday', date('Y-m-d'));
        $order->customer()->setField('birthday_use', null);
        $this->order = new \Meling\Cart\Providers\Subjects\Order($order, $this->orm->repositories());
        $this->assertInstanceOf('\DateTime', $this->customer->dateBirthday());
        $this->assertInstanceOf('\DateTime', $this->order->dateBirthday());
        $this->assertNull($this->session->dateBirthday());
    }

    public function testMethodDateMarriage()
    {
        $this->assertInstanceOf('\DateTime', $this->customer->dateMarriage());
        $this->assertInstanceOf('\DateTime', $this->order->dateMarriage());
        $this->assertNull($this->session->dateMarriage());
    }

    public function testMethodDateMarriageNull()
    {
        /**
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $customer
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $order
         */
        $customer = $this->orm->query('customer')->findOne();
        $customer->setField('marriage', null);
        $this->customer = new \Meling\Cart\Providers\Subjects\Customer($customer, $this->orm->repositories());
        $order          = $this->orm->query('order')->findOne();
        $order->customer()->setField('marriage', null);
        $this->order = new \Meling\Cart\Providers\Subjects\Order($order, $this->orm->repositories());
        $this->assertNull($this->customer->dateMarriage());
        $this->assertNull($this->order->dateMarriage());
        $this->assertNull($this->session->dateMarriage());
    }

    public function testMethodDateMarriageUse()
    {
        /**
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $customer
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $order
         */
        $customer = $this->orm->query('customer')->findOne();
        $customer->setField('marriage', date('Y-m-d'));
        $customer->setField('marriage_use', date('Y-m-d'));
        $this->customer = new \Meling\Cart\Providers\Subjects\Customer($customer, $this->orm->repositories());
        $order          = $this->orm->query('order')->findOne();
        $order->customer()->setField('marriage', date('Y-m-d'));
        $order->customer()->setField('marriage_use', date('Y-m-d'));
        $this->order = new \Meling\Cart\Providers\Subjects\Order($order, $this->orm->repositories());
        $this->assertNull($this->customer->dateMarriage());
        $this->assertNull($this->order->dateMarriage());
        $this->assertNull($this->session->dateMarriage());
    }

    public function testMethodDateMarriageUseNot()
    {
        /**
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $customer
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity $order
         */
        $customer = $this->orm->query('customer')->findOne();
        $customer->setField('marriage', date('Y-m-d'));
        $customer->setField('marriage_use', null);
        $this->customer = new \Meling\Cart\Providers\Subjects\Customer($customer, $this->orm->repositories());
        $order          = $this->orm->query('order')->findOne();
        $order->customer()->setField('marriage', date('Y-m-d'));
        $order->customer()->setField('marriage_use', null);
        $this->order = new \Meling\Cart\Providers\Subjects\Order($order, $this->orm->repositories());
        $this->assertInstanceOf('\DateTime', $this->customer->dateMarriage());
        $this->assertInstanceOf('\DateTime', $this->order->dateMarriage());
        $this->assertNull($this->session->dateMarriage());
    }

    public function testMethodProducts()
    {
        $this->assertInstanceOf('\Meling\Cart\Providers\Objects\Repository', $this->customer->products());
        $this->assertInstanceOf('\Meling\Cart\Providers\Objects\Repository', $this->order->products());
        $this->assertInstanceOf('\Meling\Cart\Providers\Objects\Session', $this->session->products());
    }

    public function testMethodCertificates()
    {
        $this->assertInstanceOf('\Meling\Cart\Providers\Objects\Repository', $this->customer->certificates());
        $this->assertInstanceOf('\Meling\Cart\Providers\Objects\Repository', $this->order->certificates());
        $this->assertInstanceOf('\Meling\Cart\Providers\Objects\Session', $this->session->certificates());
    }

}
