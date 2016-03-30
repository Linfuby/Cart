<?php
namespace Meling\Tests\Cart\Objects;

/**
 * Объект Опции
 * 1. Идентификатор
 * 2. Сущность
 * 3. Стоимость
 * 4. Количество
 * 5. Идентфикатор Точки отправления
 * 6. Идентификатор Тарифа доставки
 * 7. Идентификатор Точки получения
 * 8. Пункт выдачи
 * Class OptionTest
 * @package Meling\Tests\Cart\Objects
 */
class OptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Objects\Option
     */
    protected $option;

    public function setUp()
    {
        /**
         * @var \Meling\Cart\Wrappers\Option\Entity $entity
         */
        $entity       = $this->getMock('\Meling\Cart\Wrappers\Option\Entity', array(), array(), '', false);
        $this->option = new \Meling\Cart\Objects\Option(1, $entity, 1000, 2);
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeAddressId()
    {
        $this->assertAttributeEquals(null, 'addressId', $this->option);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->option);
    }

    public function testAttributeOption()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Wrappers\Option\Entity', 'entity', $this->option);
    }

    public function testAttributePrice()
    {
        $this->assertAttributeEquals(1000, 'price', $this->option);
    }

    public function testAttributePvz()
    {
        $this->assertAttributeEquals(null, 'pvz', $this->option);
    }

    public function testAttributeQuantity()
    {
        $this->assertAttributeEquals(2, 'quantity', $this->option);
    }

    public function testAttributeShopId()
    {
        $this->assertAttributeEquals(null, 'shopId', $this->option);
    }

    public function testAttributeShopTariffId()
    {
        $this->assertAttributeEquals(null, 'shopTariffId', $this->option);
    }

    public function testMethodAddressId()
    {
        $this->assertEquals(null, $this->option->getAddressId());
    }

    public function testMethodCertificate()
    {
        $this->assertInstanceOf('\Meling\Cart\Wrappers\Option\Entity', $this->option->getEntity());
    }

    public function testMethodId()
    {
        $this->assertEquals(1, $this->option->getId());
    }

    public function testMethodPrice()
    {
        $this->assertEquals(1000, $this->option->getPrice());
    }

    public function testMethodPvz()
    {
        $this->assertEquals(null, $this->option->getPvz());
    }

    public function testMethodQuantity()
    {
        $this->assertEquals(2, $this->option->getQuantity());
    }

    public function testMethodShopId()
    {
        $this->assertEquals(null, $this->option->getShopId());
    }

    public function testMethodShopTariffId()
    {
        $this->assertEquals(null, $this->option->getShopTariffId());
    }

}
