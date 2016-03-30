<?php
namespace Meling\Cart\Orders;

/**
 * Заказ
 * Class OrderTest
 * @package Meling\Cart\Orders
 */
class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order
     */
    protected $order;

    public function setUp()
    {
        // Создаем объект Покупателя
        $customer = \Meling\Cart\CustomerTest::getCustomer(1);
        // Создаем объект Объектов
        $provider = \Meling\Cart\Provider\OrderTest::getProvider();
        // Создаем объект Товаров
        $products = new \Meling\Cart\Products($provider);
        // Создаем объект Опции
        $objectOption = \Meling\Cart\Objects\OptionTest::getOption();
        // Добавляем к Товарам
        $products->addOption($objectOption);
        // Создаем объект Сертификата
        $objectCertificate = \Meling\Cart\Objects\CertificateTest::getCertificate();
        // Добавляем к Товарам
        $products->addCertificate($objectCertificate);
        // Содаем заказ
        $this->order = new \Meling\Cart\Orders\Order(1, $customer, $products);
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeCustomer()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Customer', 'customer', $this->order);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->order);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Products', 'products', $this->order);
    }

    public function testMethodAddCertificate()
    {
        $certificate = \Meling\Cart\Objects\CertificateTest::getCertificate();
        $this->assertInternalType('int', $this->order->addCertificate($certificate));
    }

    public function testMethodAddOption()
    {
        $option = \Meling\Cart\Objects\OptionTest::getOption();
        $this->assertInternalType('int', $this->order->addOption($option));
    }

}
