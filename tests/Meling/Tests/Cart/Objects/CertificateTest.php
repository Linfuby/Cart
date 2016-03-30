<?php
namespace Meling\Tests\Cart\Objects;

/**
 * Объект Сертификата
 * 1. Идентификатор
 * 2. Сущность
 * 3. Изображение
 * 4. Стоимость
 * 5. Количество
 * 6. Идентфикатор Точки отправления
 * 7. Идентификатор Тарифа доставки
 * 8. Идентификатор Точки получения
 * 9. Пункт выдачи
 * Class CertificateTest
 * @package Meling\Tests\Cart\Objects
 */
class CertificateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Objects\Certificate
     */
    protected $certificate;

    public function setUp()
    {
        /**
         * @var \Meling\Cart\Wrappers\Certificate\Entity $entity
         */
        $entity            = $this->getMock('\Meling\Cart\Wrappers\Certificate\Entity', array(), array(), '', false);
        $this->certificate = new \Meling\Cart\Objects\Certificate(1, $entity, 'image.jpg', 500);
    }

    public function testAttributeAddressId()
    {
        $this->assertAttributeEquals(null, 'addressId', $this->certificate);
    }

    public function testAttributeCertificate()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Wrappers\Certificate\Entity', 'entity', $this->certificate);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->certificate);
    }

    public function testAttributePrice()
    {
        $this->assertAttributeEquals(500, 'price', $this->certificate);
    }

    public function testAttributePvz()
    {
        $this->assertAttributeEquals(null, 'pvz', $this->certificate);
    }

    public function testAttributeQuantity()
    {
        $this->assertAttributeEquals(1, 'quantity', $this->certificate);
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
        $this->assertEquals(null, $this->certificate->getAddressId());
    }

    public function testMethodCertificate()
    {
        $this->assertInstanceOf('\Meling\Cart\Wrappers\Certificate\Entity', $this->certificate->getEntity());
    }

    public function testMethodId()
    {
        $this->assertEquals(1, $this->certificate->getId());
    }

    public function testMethodPrice()
    {
        $this->assertEquals(500, $this->certificate->getPrice());
    }

    public function testMethodPvz()
    {
        $this->assertEquals(null, $this->certificate->getPvz());
    }

    public function testMethodQuantity()
    {
        $this->assertEquals(1, $this->certificate->getQuantity());
    }

    public function testMethodShopId()
    {
        $this->assertEquals(null, $this->certificate->getShopId());
    }

    public function testMethodShopTariffId()
    {
        $this->assertEquals(null, $this->certificate->getShopTariffId());
    }

}
