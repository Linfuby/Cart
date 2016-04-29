<?php
namespace Meling\Tests\Cart\Providers;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Guest
     */
    protected $providerOrder;

    public function setUp()
    {
        $orm     = new \Meling\Tests\ORM();
        $session = new \Meling\Tests\Session();
        /** @var \Meling\Tests\ORMWrappers\Entities\Order $order */
        $order               = $orm->query('order')->in(1)->findOne();
        $this->providerOrder = new \Meling\Cart\Providers\Order($orm, $session, $order);

    }

    public function testAttributeOrm()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM', 'orm', $this->providerOrder);

        $this->providerOrder->orm()->disconnect();
    }

    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session', 'session', $this->providerOrder);

        $this->providerOrder->orm()->disconnect();
    }

    public function testMethodCertificates()
    {
        $this->assertInternalType('array', $this->providerOrder->certificates());

        $this->providerOrder->orm()->disconnect();
    }

    public function testMethodCustomer()
    {
        $this->assertInstanceOf('\Meling\Cart\Providers\Customer', $this->providerOrder->customer());

        $this->providerOrder->orm()->disconnect();
    }

    public function testMethodOptions()
    {
        $this->assertInternalType('array', $this->providerOrder->options());

        $this->providerOrder->orm()->disconnect();
    }

    public function testMethodOrm()
    {
        $this->assertInstanceOf('\PHPixie\ORM', $this->providerOrder->orm());

        $this->providerOrder->orm()->disconnect();
    }

    public function testMethodSession()
    {
        $this->assertInstanceOf('\PHPixie\HTTP\Context\Session', $this->providerOrder->session());

        $this->providerOrder->orm()->disconnect();
    }

}
