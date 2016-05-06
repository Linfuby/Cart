<?php
namespace Meling\Tests\Cart\Orders\Order;

class CertificatesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Certificates
     */
    protected $certificates;

    public static function getCertificates()
    {
        $provider = \Meling\Tests\Cart\Providers\CustomerTest::getCustomer();

        return new \Meling\Cart\Orders\Order\Certificates($provider, $provider->certificates());
    }

    public function setUp()
    {
        $this->certificates = $this->getCertificates();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeCertificates()
    {
        $this->assertAttributeInternalType('array', 'certificates', $this->certificates);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->certificates);
    }

}
