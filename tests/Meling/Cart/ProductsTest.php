<?php
namespace Meling\Cart;

class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    public function setUp()
    {
        $provider       = \Meling\Cart\Provider\CustomTest::getProvider(array(
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
        ));
        $this->products = new \Meling\Cart\Products($provider);
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Provider\Custom', 'provider', $this->products);
    }

    public function testMethodAddCertificate(){
        $certificate = \Meling\Cart\Objects\CertificateTest::getCertificate();
        $this->assertInternalType('int', $this->products->addCertificate($certificate));
    }

    public function testMethodAddOption(){
        $option = \Meling\Cart\Objects\OptionTest::getOption();
        $this->assertInternalType('int', $this->products->addOption($option));
    }

    public function testMethodAsArray(){
        $this->products->asArray();
        $this->assertInternalType('array', $this->products->asArray());
    }

}
