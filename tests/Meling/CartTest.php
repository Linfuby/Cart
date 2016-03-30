<?php
namespace Meling;

/**
 * Class CartTest
 * @package Meling\Tests
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart
     */
    protected        $cart;

    protected static $database;

    protected static $orm;

    public static function getDatabase()
    {
        if(self::$database === null) {
            var_dump(__FUNCTION__);
            $slice          = new \PHPixie\Slice();
            $config         = $slice->arrayData(
                array(
                    'default' => array(
                        'driver'     => 'pdo',
                        'connection' => 'mysql:host=localhost;dbname=parishop_pixie',
                        'user'       => 'parishop',
                        'password'   => 'xd7pL2yvcL9yXUZ8fE7C',
                        'database'   => 'parishop_pixie',
                    ),
                )
            );
            self::$database = new \PHPixie\Database($config);
        }

        return self::$database;
    }

    public static function getORM()
    {
        if(self::$orm === null) {
            var_dump(__FUNCTION__);
            /**
             * @var \PHPixie\Config\Storages $storages
             */
            $config    = new \PHPixie\Config(new \PHPixie\Slice());
            $config    = $config->directory(__DIR__, 'config')->arraySlice('orm');
            $wrappers  = new \Meling\Cart\Wrappers();
            self::$orm = new \PHPixie\ORM(\Meling\CartTest::getDatabase(), $config, $wrappers);
        }

        return self::$orm;
    }

    public function setUp()
    {
        /**
         * @var \Meling\Cart\Wrappers\Order\Entity $order
         */
        $customer   = \Meling\Cart\CustomerTest::getGuest();
        $entity     = \Meling\CartTest::getORM()->createEntity('order');
        $order      = new \Meling\Cart\Wrappers\Order\Entity($entity);
        $provider   = new \Meling\Cart\Provider\Order($order);
        $this->cart = new \Meling\Cart($customer, $provider);
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('Meling\Cart\Provider\Order', 'provider', $this->cart);
    }

    public function testMethodOrders()
    {
        $this->assertInstanceOf('Meling\Cart\Orders', $this->cart->orders());
    }

}
