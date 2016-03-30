<?php
namespace Meling\Cart\Provider;

class GuestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Provider\Guest
     */
    protected $provider;

    public static function getProvider($id = null, $data = array())
    {
        return new \Meling\Cart\Provider\Guest(new SAPIStub($data));
    }

    public function setUp()
    {
        $this->provider = $this->getProvider();
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeOrder()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session', 'guest', $this->provider);
    }

    public function testMethodObjects()
    {
        $this->assertInstanceOf('\Meling\Cart\Objects', $this->provider->objects());
    }

}

/**
 * @coversDefaultClass PHPixie\HTTP\Context\Session\SAPI
 */
class SAPIStub extends \PHPixie\HTTP\Context\Session\SAPI
{
    protected $sessionArray;

    protected $sessionStarted = false;

    public function __construct(&$sessionArray)
    {
        $this->sessionArray = &$sessionArray;
    }

    public function isSessionStarted()
    {
        return $this->sessionStarted;
    }

    protected function &session()
    {
        return $this->sessionArray;
    }

    protected function sessionStart()
    {
        $this->sessionStarted = true;
    }
}