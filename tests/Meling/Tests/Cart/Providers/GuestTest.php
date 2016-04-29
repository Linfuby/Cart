<?php
namespace Meling\Tests\Cart\Providers;

class GuestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Guest
     */
    protected $providerGuest;

    public function setUp()
    {
        $orm                 = new \Meling\Tests\ORM();
        $session             = new \Meling\Tests\Session(
            array(
                'options'      => array(
                    array(
                        'optionId' => '-169235494',
                    ),
                ),
                'certificates' => array(
                    array(
                        'certificateId' => '2',
                    ),
                ),
            )
        );
        $this->providerGuest = new \Meling\Cart\Providers\Guest($orm, $session);

    }

    public function testAttributeOrm()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM', 'orm', $this->providerGuest);

        $this->providerGuest->orm()->disconnect();
    }

    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session', 'session', $this->providerGuest);

        $this->providerGuest->orm()->disconnect();
    }

    public function testMethodCertificates()
    {
        $this->assertInternalType('array', $this->providerGuest->certificates());

        $this->providerGuest->orm()->disconnect();
    }

    public function testMethodCustomer()
    {
        $this->assertInstanceOf('\Meling\Cart\Providers\Customer', $this->providerGuest->customer());

        $this->providerGuest->orm()->disconnect();
    }

    public function testMethodOptions()
    {
        $this->assertInternalType('array', $this->providerGuest->options());

        $this->providerGuest->orm()->disconnect();
    }

    public function testMethodOrm()
    {
        $this->assertInstanceOf('\PHPixie\ORM', $this->providerGuest->orm());

        $this->providerGuest->orm()->disconnect();
    }

    public function testMethodSession()
    {
        $this->assertInstanceOf('\PHPixie\HTTP\Context\Session', $this->providerGuest->session());

        $this->providerGuest->orm()->disconnect();
    }

}
