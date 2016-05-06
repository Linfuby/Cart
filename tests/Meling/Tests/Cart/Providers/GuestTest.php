<?php
namespace Meling\Tests\Cart\Providers;

class GuestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Guest
     */
    protected $guest;

    public static function getGuest($session = array(), $actionTypeId = null)
    {
        $source = \Meling\Tests\Cart\SourceTest::getSource($session, $actionTypeId);

        return new \Meling\Cart\Providers\Guest($source);
    }

    public function setUp()
    {
        $cart        = \Meling\Tests\CartTest::getCartGuest();
        $this->guest = $cart->builder()->context()->provider();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(0, 'id', $this->guest);
    }

    public function testAttributeSource()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Source', 'source', $this->guest);
    }

    public function testMethodCards()
    {
        $this->assertInternalType('array', $this->guest->cards());
    }

    public function testMethodCertificates()
    {
        $this->assertInternalType('array', $this->guest->certificates());
    }

    public function testMethodDateActual()
    {
        $this->assertEquals(new \DateTime(), $this->guest->dateActual());
    }

    public function testMethodDateBirthday()
    {
        $this->assertNull($this->guest->dateBirthday());
    }

    public function testMethodDateMarriage()
    {
        $this->assertNull($this->guest->dateMarriage());
    }

    public function testMethodId()
    {
        $this->assertEquals(0, $this->guest->id());
    }

    public function testMethodProducts()
    {
        $this->assertInternalType('array', $this->guest->products());
    }

}
