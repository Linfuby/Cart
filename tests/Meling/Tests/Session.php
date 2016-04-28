<?php
namespace Meling\Tests;

/**
 * Class Session
 * @package Meling\Tests
 */
class Session extends \PHPixie\HTTP\Context\Session\SAPI
{
    protected $sessionArray;

    protected $sessionStarted = false;

    public function __construct($sessionArray = array())
    {
        $this->sessionArray = $sessionArray;
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
