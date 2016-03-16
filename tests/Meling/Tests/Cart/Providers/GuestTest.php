<?php
namespace Meling\Tests\Cart\Providers;

class GuestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Guest
     */
    protected $guest;

    public static function getGuest($session = array())
    {
        $source    = \Meling\Tests\Cart\SourceTest::getSource();

        return new \Meling\Cart\Providers\Guest($source);
    }

    public function setUp()
    {
        $this->guest = $this->getGuest();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getORM()->builder()->database()->connection('default')->disconnect();
    }

    public function testAttributeId()
    {
        $guest = $this->getGuest();
        $this->assertAttributeEquals(0, 'id', $guest);
    }

    public function testAttributeSource()
    {
        $guest = $this->getGuest();
        $this->assertAttributeInstanceOf('\Meling\Cart\Source', 'source', $guest);
    }

    public function testMethodCards()
    {
        $guest = $this->getGuest();
        $this->assertInternalType('array', $guest->cards());
    }

    public function testMethodCertificates()
    {
        $guest = $this->getGuest();
        $this->assertInternalType('array', $guest->certificates());
    }

    public function testMethodDateActual()
    {
        $guest = $this->getGuest();
        $this->assertEquals(new \DateTime(), $guest->dateActual());
    }

    public function testMethodDateBirthday()
    {
        $guest = $this->getGuest();
        $this->assertNull($guest->dateBirthday());
    }

    public function testMethodDateMarriage()
    {
        $guest = $this->getGuest();
        $this->assertNull($guest->dateMarriage());
    }

    public function testMethodId()
    {
        $guest = $this->getGuest();
        $this->assertEquals(0, $guest->id());
    }

    public function testMethodProducts()
    {
        $guest = $this->getGuest();
        $this->assertInternalType('array', $guest->products());
    }

}
