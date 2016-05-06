<?php
namespace Meling\Tests;

/**
 * Тестирование корзины
 * Class CartTest
 * @package Meling\Tests
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    static $framework;

    /**
     * Корзина Авторизованного Покупателя
     * @var \Meling\Cart
     */
    protected $cartCustomer;

    /**
     * Корзина Гостя
     * @var \Meling\Cart
     */
    protected $cartGuest;

    /**
     * Корзина Заказа
     * @var \Meling\Cart
     */
    protected $cartOrder;

    /**
     * Создание корзины для Авторизованного Покупателя
     * @param int    $id           Иденетификатор Покупателя
     * @param array  $data         Данные Покупателя
     * @param array  $session      Сессия
     * @param string $actionTypeId Тип Акции для Корзины
     * @return \Meling\Cart
     */
    public static function getCartCustomer($id = null, $data = array(), $session = array(), $actionTypeId = null)
    {
        $context = \Meling\Tests\Cart\ContextTest::getContextCustomer($id, $data, $session, $actionTypeId);

        return new \Meling\Cart($context);
    }

    /**
     * Создание корзины для Гостя
     * @param array  $session      Сессия
     * @param string $actionTypeId Тип Акции для Корзины
     * @return \Meling\Cart
     */
    public static function getCartGuest($session = array(), $actionTypeId = null)
    {
        $context = \Meling\Tests\Cart\ContextTest::getContextGuest($session, $actionTypeId);

        return new \Meling\Cart($context);
    }

    /**
     * Создание корзины для Заказа
     * @param int   $id   Иденетификатор Заказа
     * @param array $data Данные Заказа
     * @return \Meling\Cart
     */
    public static function getCartOrder($id = null, $data = array())
    {
        $context = \Meling\Tests\Cart\ContextTest::getContextOrder($id, $data);

        return new \Meling\Cart($context);
    }

    public static function getFramework()
    {
        if(self::$framework === null) {
            self::$framework = new \Parishop\Framework();
        }

        return self::$framework;
    }

    /**
     * Инициализация корзины для Авторизованного Покупателя
     */
    public function setUp()
    {
        $this->cartCustomer = $this->getCartCustomer();
        $this->cartGuest    = $this->getCartGuest();
        $this->cartOrder    = $this->getCartOrder();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    /**
     * Проверка Атрибута Строителя
     */
    public function testAttributeBuilder()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->cartCustomer);
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->cartGuest);
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->cartOrder);
    }

    /**
     * Акции доступные в корзине
     */
    public function testMethodActions()
    {
        $this->assertInstanceOf('\Meling\Cart\Actions', $this->cartCustomer->actions());
        $this->assertInstanceOf('\Meling\Cart\Actions', $this->cartGuest->actions());
        $this->assertInstanceOf('\Meling\Cart\Actions', $this->cartOrder->actions());
    }

    /**
     * Строитель корзины
     */
    public function testMethodBuilder()
    {
        $this->assertInstanceOf('\Meling\Cart\Builder', $this->cartCustomer->builder());
        $this->assertInstanceOf('\Meling\Cart\Builder', $this->cartGuest->builder());
        $this->assertInstanceOf('\Meling\Cart\Builder', $this->cartOrder->builder());
    }

    /**
     * Клубные карты доступные в корзине
     */
    public function testMethodCards()
    {
        $this->assertInstanceOf('\Meling\Cart\Cards', $this->cartCustomer->cards());
        $this->assertInstanceOf('\Meling\Cart\Cards', $this->cartGuest->cards());
        $this->assertInstanceOf('\Meling\Cart\Cards', $this->cartOrder->cards());
    }

    /**
     * Сертификаты Заказа по Умолчанию
     */
    public function testMethodCertificates()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Certificates', $this->cartCustomer->certificates());
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Certificates', $this->cartGuest->certificates());
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Certificates', $this->cartOrder->certificates());
    }

    /**
     * Заказы в корзине
     */
    public function testMethodOrders()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders', $this->cartCustomer->orders());
        $this->assertInstanceOf('\Meling\Cart\Orders', $this->cartGuest->orders());
        $this->assertInstanceOf('\Meling\Cart\Orders', $this->cartOrder->orders());
    }

    /**
     * Товары Заказа по Умолчанию
     */
    public function testMethodProducts()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Products', $this->cartCustomer->products());
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Products', $this->cartGuest->products());
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Products', $this->cartOrder->products());
    }

    /**
     * Итоговые суммы Заказа по Умолчанию
     */
    public function testMethodTotals()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Totals', $this->cartCustomer->totals());
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Totals', $this->cartGuest->totals());
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Totals', $this->cartOrder->totals());
    }

}
