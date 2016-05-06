<?php
namespace Meling\Tests\Cart;

/**
 * Тестирование контекста корзины
 * Class ContextTest
 * @package Meling\Tests\Cart
 */
class ContextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Контекст Авторизованного Покупателя
     * @var \Meling\Cart\Context
     */
    protected $contextCustomer;

    /**
     * Контекст Гостя
     * @var \Meling\Cart\Context
     */
    protected $contextGuest;

    /**
     * Контекст Заказа
     * @var \Meling\Cart\Context
     */
    protected $contextOrder;

    /**
     * Создание контекста Авторизованного Покупателя
     * @param int    $id           Иденетификатор Покупателя
     * @param array  $data         Данные Покупателя
     * @param array  $session      Сессия
     * @param string $actionTypeId Тип Акции для Корзины
     * @return \Meling\Cart\Context
     */
    public static function getContextCustomer($id = null, $data = array(), $session = array(), $actionTypeId = null)
    {
        $provider = \Meling\Tests\Cart\Providers\CustomerTest::getCustomer($id, $data, $session, $actionTypeId);

        return new \Meling\Cart\Context($provider);
    }

    /**
     * Создание контекста Гостя
     * @param array  $session      Сессия
     * @param string $actionTypeId Тип Акции для Корзины
     * @return \Meling\Cart\Context
     */
    public static function getContextGuest($session = array(), $actionTypeId = null)
    {
        $provider = \Meling\Tests\Cart\Providers\GuestTest::getGuest($session, $actionTypeId);

        return new \Meling\Cart\Context($provider);
    }

    /**
     * Создание контекста Заказа
     * @param int   $id   Иденетификатор Заказа
     * @param array $data Данные Заказа
     * @return \Meling\Cart\Context
     */
    public static function getContextOrder($id = null, $data = array())
    {
        $provider = \Meling\Tests\Cart\Providers\OrderTest::getOrder($id, $data);

        return new \Meling\Cart\Context($provider);
    }

    /**
     * Инициализация Конекста
     */
    public function setUp()
    {
        $this->contextCustomer = $this->getContextCustomer();
        $this->contextGuest    = $this->getContextGuest();
        $this->contextOrder    = $this->getContextOrder();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->contextCustomer);
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->contextGuest);
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->contextOrder);
    }

    public function testMethodCertificates()
    {
        $this->assertInternalType('array', $this->contextCustomer->certificates());
        $this->assertInternalType('array', $this->contextGuest->certificates());
        $this->assertInternalType('array', $this->contextOrder->certificates());
    }

    public function testMethodProducts()
    {
        $this->assertInternalType('array', $this->contextCustomer->products());
        $this->assertInternalType('array', $this->contextGuest->products());
        $this->assertInternalType('array', $this->contextOrder->products());
    }

}
