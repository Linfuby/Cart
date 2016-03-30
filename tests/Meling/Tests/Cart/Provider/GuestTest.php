<?php
namespace Meling\Tests\Cart\Provider;

/**
 * Провайдер Гостя
 * 1. Сессия
 * Class GuestTest
 * @package Meling\Tests\Cart\Provider
 */
class GuestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Provider\Guest
     */
    protected $provider;

    public function setUp()
    {
        $data           = array();
        $this->provider = new \Meling\Cart\Provider\Guest(new SAPIStub($data));
    }

    public function testAttributeOrder()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session', 'guest', $this->provider);
    }

    public function testMethodObjects()
    {
        $this->assertInstanceOf('\Meling\Cart\Objects', $this->provider->objects());
    }

    public function testMethodRewards()
    {
        $this->assertInternalType('int', $this->provider->rewards());
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
