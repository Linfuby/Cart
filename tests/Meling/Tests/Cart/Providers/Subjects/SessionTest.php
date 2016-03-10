<?php
namespace Meling\Tests\Cart\Providers\Subjects;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    public static function getSession($session = array())
    {
        return new SAPIStub($session);
    }

    public static function getSubject()
    {
        return new \Meling\Cart\Providers\Subjects\Session(SessionTest::getSession());
    }

    public function test()
    {
        $this->assertEquals(1, 1);
    }

}

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
