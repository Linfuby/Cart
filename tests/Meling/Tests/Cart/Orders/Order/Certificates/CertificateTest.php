<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 17.03.2016
 * Time: 8:11
 */

namespace Meling\Tests\Cart\Orders\Order\Certificates;

class CertificateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Certificates\Certificate
     */
    protected $certificate;

    public static function getCertificate($id = null)
    {
        $provider = \Meling\Tests\Cart\Providers\CustomerTest::getCustomer();
        $query    = $provider->source()->query('certificate');
        if($id) {
            $query->in($id);
        }
        /**
         * @var \Parishop\ORMWrappers\Certificate\Entity $certificate
         */
        $certificate = $query->findOnePreload();

        return new \Meling\Cart\Orders\Order\Certificates\Certificate($provider, $certificate, 'image.png', 500);
    }

    public function setUp()
    {
        $this->certificate = $this->getCertificate(1);
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeCertificate()
    {
        $this->assertAttributeInstanceOf('\Parishop\ORMWrappers\Certificate\Entity', 'certificate', $this->certificate);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->certificate);
    }

}
