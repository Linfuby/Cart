<?php
namespace Meling\Cart\Provider;

class CustomTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Provider\Custom
     */
    protected $provider;

    public static function getProvider($options, $certificates)
    {
        return new \Meling\Cart\Provider\Custom($options, $certificates);
    }

    public function setUp()
    {
        $this->provider = $this->getProvider(
            array(
                (object)array(
                    'id'           => 1,
                    'option'       => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => 1,
                    'deliveryId'   => null,
                    'shopTariffId' => null,
                    'addressId'    => null,
                ),
                (object)array(
                    'id'           => 1,
                    'option'       => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => 1,
                    'deliveryId'   => 2,
                    'shopTariffId' => 2,
                    'addressId'    => 2,
                ),
            ), array(
                (object)array(
                    'id'           => 1,
                    'certificate'  => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => 1,
                    'deliveryId'   => null,
                    'shopTariffId' => null,
                    'addressId'    => null,
                ),
                (object)array(
                    'id'           => 1,
                    'certificate'  => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => 1,
                    'deliveryId'   => 2,
                    'shopTariffId' => 2,
                    'addressId'    => 2,
                ),
            )
        );
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeCertificates()
    {
        $this->assertAttributeInternalType('array', 'certificates', $this->provider);
    }

    public function testAttributeOptions()
    {
        $this->assertAttributeInternalType('array', 'options', $this->provider);
    }

    public function testMethodObjects()
    {
        $this->assertInstanceOf('\Meling\Cart\Objects', $this->provider->objects());
    }

}
