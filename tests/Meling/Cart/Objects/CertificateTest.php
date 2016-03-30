<?php
namespace Meling\Cart\Objects;

class CertificateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Objects\Certificate
     */
    protected $certificate;

    public static function getCertificate($id = null)
    {
        /**
         * @var \PHPixie\ORM\Wrappers\Type\Database\Entity $certificate
         */
        $certificates = \Meling\CartTest::getORM()->query('certificate');
        if($id !== null) {
            $certificates->in($id);
        }
        $certificate = $certificates->findOne();

        return new \Meling\Cart\Objects\Certificate($certificate->id(), $certificate, $certificate->getField('price'));
    }

    public function setUp()
    {
        $this->certificate = $this->getCertificate();
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeAddressId()
    {
        $this->assertAttributeEquals(null, 'addressId', $this->certificate);
    }

    public function testAttributeCertificate()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Wrappers\Type\Database\Entity', 'entity', $this->certificate);
    }

    public function testAttributeDeliveryId()
    {
        $this->assertAttributeEquals(null, 'deliveryId', $this->certificate);
    }

    public function testAttributeId()
    {
        $this->assertAttributeInternalType('string', 'id', $this->certificate);
    }

    public function testAttributePrice()
    {
        $this->assertAttributeInternalType('int', 'price', $this->certificate);
    }

    public function testAttributeQuantity()
    {
        $this->assertAttributeInternalType('int', 'quantity', $this->certificate);
    }

    public function testAttributeShopId()
    {
        $this->assertAttributeEquals(null, 'shopId', $this->certificate);
    }

    public function testAttributeShopTariffId()
    {
        $this->assertAttributeEquals(null, 'shopTariffId', $this->certificate);
    }

    public function testMethodAddressId()
    {
        $this->assertEquals(null, $this->certificate->addressId());
    }

    public function testMethodCertificate()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Wrappers\Type\Database\Entity', $this->certificate->entity());
    }

    public function testMethodDeliveryId()
    {
        $this->assertEquals(null, $this->certificate->deliveryId());
    }

    public function testMethodId()
    {
        $this->assertInternalType('string', $this->certificate->id());
    }

    public function testMethodPrice()
    {
        $this->assertInternalType('int', $this->certificate->price());
    }

    public function testMethodQuantity()
    {
        $this->assertInternalType('int', $this->certificate->quantity());
    }

    public function testMethodShopId()
    {
        $this->assertEquals(null, $this->certificate->shopId());
    }

    public function testMethodShopTariffId()
    {
        $this->assertEquals(null, $this->certificate->shopTariffId());
    }

}
