<?php
namespace Meling\Tests\Cart;

class ContextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Context
     */
    protected $context;

    public static function getContextCustomer($id = null, $data = array())
    {
        $provider = \Meling\Tests\Cart\Providers\CustomerTest::getCustomer($id, $data);

        return new \Meling\Cart\Context($provider);
    }

    public static function getContextGuest($session = array())
    {
        $provider = \Meling\Tests\Cart\Providers\GuestTest::getGuest($session);

        return new \Meling\Cart\Context($provider);
    }

    public static function getContextOrder($id = null, $data = array())
    {
        $provider = \Meling\Tests\Cart\Providers\OrderTest::getOrder($id, $data);

        return new \Meling\Cart\Context($provider);
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getORM()->builder()->database()->connection('default')->disconnect();
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->getContextCustomer());
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->getContextGuest());
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->getContextOrder());
    }

    public function testMethodCertificates()
    {
        $this->assertInternalType('array', $this->getContextCustomer()->certificates());
        $this->assertInternalType('array', $this->getContextGuest()->certificates());
        $this->assertInternalType('array', $this->getContextOrder()->certificates());
    }

    public function testMethodProducts()
    {
        $this->assertInternalType('array', $this->getContextCustomer()->products());
        $this->assertInternalType('array', $this->getContextGuest()->products());
        $this->assertInternalType('array', $this->getContextOrder()->products());
    }

}
