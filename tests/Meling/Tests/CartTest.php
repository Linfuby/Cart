<?php
namespace Meling\Tests;

/**
 * Class CartTest
 * @package Meling\Tests
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart
     */
    protected $cart;

    public static function getORM()
    {
        static $orm;
        if($orm === null) {
            $slice    = new \PHPixie\Slice();
            $database = new \PHPixie\Database(
                $slice->arrayData(
                    array(
                        'default' => array(
                            'driver'     => 'pdo',
                            'connection' => 'mysql:host=localhost;dbname=parishop_pixie',
                            'user'       => 'parishop',
                            'password'   => 'xd7pL2yvcL9yXUZ8fE7C',
                            'database'   => 'parishop_pixie',
                        ),
                    )
                )
            );

            $orm = new \PHPixie\ORM(
                $database, $slice->arrayData(
                array(
                    'relationships' => array(
                        'ActionType'               => array(
                            'type'  => 'oneToMany',
                            'owner' => 'actionType',
                            'items' => 'action',
                        ),
                        'OptionActionProducts'     => array(
                            'type'  => 'oneToMany',
                            'owner' => 'option',
                            'items' => 'actionProduct',
                        ),
                        'ActionActionProducts'     => array(
                            'type'  => 'oneToMany',
                            'owner' => 'action',
                            'items' => 'actionProduct',
                        ),
                        'CartOption'               => array(
                            'type'  => 'oneToMany',
                            'owner' => 'option',
                            'items' => 'cart',
                        ),
                        'CartOptionRests'          => array(
                            'type'  => 'oneToMany',
                            'owner' => 'option',
                            'items' => 'shopRest',
                        ),
                        'ShopRests'                => array(
                            'type'  => 'oneToMany',
                            'owner' => 'shop',
                            'items' => 'shopRest',
                        ),
                        'CustomerCards'            => array(
                            'type'  => 'oneToMany',
                            'owner' => 'customer',
                            'items' => 'customerCard',
                        ),
                        'CustomerCarts'            => array(
                            'type'  => 'oneToMany',
                            'owner' => 'customer',
                            'items' => 'cart',
                        ),
                        'CustomerCartCertificates' => array(
                            'type'  => 'oneToMany',
                            'owner' => 'customer',
                            'items' => 'cartCertificate',
                        ),
                        'OrderProducts'            => array(
                            'type'  => 'oneToMany',
                            'owner' => 'order',
                            'items' => 'orderProduct',
                        ),
                        'OrderCertificates'        => array(
                            'type'  => 'oneToMany',
                            'owner' => 'order',
                            'items' => 'orderCertificate',
                        ),
                        'CustomerOrders'           => array(
                            'type'  => 'oneToMany',
                            'owner' => 'customer',
                            'items' => 'order',
                        ),
                    ),
                )
            )
            );
        }

        return $orm;
    }

    /**
     * Инициализация корзины. Конструктор принимает провайдера
     */
    public function setUp()
    {
        $context    = \Meling\Tests\Cart\ContextTest::getContextCustomer();
        $this->cart = new \Meling\Cart($context);
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getORM()->builder()->database()->connection('default')->disconnect();
    }

    public function testAttributeOrders()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders', 'orders', $this->cart);
    }

    public function testMethodActions()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions', $this->cart->actions());
    }

    public function testMethodCards()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Actions\Cards', $this->cart->cards());
    }

    public function testMethodCertificates()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Certificates', $this->cart->certificates());
    }

    public function testMethodOrders()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders', $this->cart->orders());
    }

    public function testMethodProducts()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Products', $this->cart->products());
    }

    public function testMethodShops()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Shops', $this->cart->shops());
    }

    public function testMethodTotals()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order\Totals', $this->cart->totals());
    }

}
