<?php
namespace Meling\Tests\Cart\Providers;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Guest
     */
    protected $providerUser;

    public function setUp()
    {
        $orm     = new \Meling\Tests\ORM();
        $session = new \Meling\Tests\Session();
        /** @var \Meling\Tests\ORMWrappers\Entities\Customer $user */
        $user               = $orm->query('customer')->in(1)->findOne();
        $this->providerUser = new \Meling\Cart\Providers\User($orm, $session, $user);
    }

    public function testAttributeOrm()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM', 'orm', $this->providerUser);

        $this->providerUser->orm()->disconnect();
    }

    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session', 'session', $this->providerUser);

        $this->providerUser->orm()->disconnect();
    }

    public function testMethodCertificates()
    {
        $this->assertInternalType('array', $this->providerUser->certificates());

        $this->providerUser->orm()->disconnect();
    }

    public function testMethodCustomer()
    {
        $this->assertInstanceOf('\Meling\Cart\Providers\Customer', $this->providerUser->customer());

        $this->providerUser->orm()->disconnect();
    }

    public function testMethodOptions()
    {
        $this->assertInternalType('array', $this->providerUser->options());

        $this->providerUser->orm()->disconnect();
        unset($this->providerUser);
    }

    public function testMethodOrm()
    {
        $this->assertInstanceOf('\PHPixie\ORM', $this->providerUser->orm());

        $this->providerUser->orm()->disconnect();
    }

    public function testMethodSession()
    {
        $this->assertInstanceOf('\PHPixie\HTTP\Context\Session', $this->providerUser->session());

        $this->providerUser->orm()->disconnect();
    }

}
