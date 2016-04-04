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
    protected        $cart;

    protected static $database;

    protected static $orm;

    public static function getDatabase()
    {
        if(self::$database === null) {
            $slice          = new \PHPixie\Slice();
            $config         = $slice->arrayData(
                array(
                    'default' => array(
                        'driver'     => 'pdo',
                        'connection' => 'mysql:host=localhost;dbname=parishop_pixie_new',
                        'user'       => 'parishop',
                        'password'   => 'xd7pL2yvcL9yXUZ8fE7C',
                        'database'   => 'parishop_pixie_new',
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
            /**
             * @var \PHPixie\Config\Storages $storages
             */
            $config    = new \PHPixie\Config(new \PHPixie\Slice());
            $config    = $config->directory(__DIR__, 'config')->arraySlice('orm');
            $wrappers  = new \Meling\Cart\Wrappers();
            self::$orm = new \PHPixie\ORM(\Meling\Tests\CartTest::getDatabase(), $config, $wrappers);
        }

        return self::$orm;
    }

    public function setUp()
    {
        /**
         * @var \Meling\Cart\Customer          $customer
         * @var \Meling\Cart\Provider\Customer $provider
         */
        $customer   = $this->getMock('\Meling\Cart\Customer', array(), array(), '', false);
        $provider   = $this->getMock('\Meling\Cart\Provider\Customer', array(), array(), '', false);
        $this->cart = new \Meling\Cart($customer, $provider);
    }

    public function testAttributeCustomer()
    {
        $this->assertAttributeInstanceOf('Meling\Cart\Customer', 'customer', $this->cart);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('Meling\Cart\Provider\Customer', 'provider', $this->cart);
    }

    public function testMethodOrders()
    {
        $this->assertInstanceOf('Meling\Cart\Orders', $this->cart->orders());
    }

}
