<?php
namespace Meling\Tests;

/**
 * Class CartOptionsTest
 * @package Meling\Tests
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPixie\ORM
     */
    public static $orm;

    /**
     * @var \Meling\Cart
     */
    protected $cart;

    public static function getORM()
    {
        if(\Meling\Tests\CartTest::$orm === null) {
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

            \Meling\Tests\CartTest::$orm = new \PHPixie\ORM(
                $database, $slice->arrayData(
                array(
                    'relationships' => array(
                        'ActionType'     => array(
                            'type'  => 'oneToMany',
                            'owner' => 'actionType',
                            'items' => 'action',
                        ),
                        'CustomerCards'  => array(
                            'type'  => 'oneToMany',
                            'owner' => 'customer',
                            'items' => 'customerCard',
                        ),
                        'CustomerOrders' => array(
                            'type'  => 'oneToMany',
                            'owner' => 'customer',
                            'items' => 'order',
                        ),
                    ),
                )
            )
            );
        }

        return \Meling\Tests\CartTest::$orm;
    }

    public function setUp()
    {
        self::$orm   = $this->getORM();
        $customer    = \Meling\Tests\Cart\Providers\Subjects\CustomerTest::getCustomer();
        $subject     = \Meling\Tests\Cart\Providers\Subjects\CustomerTest::getSubject();
        $objects     = \Meling\Tests\Cart\Providers\Objects\ObjectTest::getObjectRepository(
            'cart', 'customerId', $customer->id()
        );
        $environment = new \Meling\Cart\Providers\Environments\Environment(
            \Meling\Tests\Cart\Providers\Subjects\SessionTest::getSession(),
            \Meling\Tests\CartTest::$orm->repositories()
        );
        $this->cart  = new \Meling\Cart($subject, $objects, $environment);
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::$orm->builder()->database()->connection('default')->disconnect();
    }

    public function testAttributeBuilder()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->cart);
    }

    public function testMethodActions()
    {
        $this->assertInstanceOf('\Meling\Cart\Actions', $this->cart->actions());
    }

    public function testMethodCards()
    {
        $this->assertInstanceOf('\Meling\Cart\Cards', $this->cart->cards());
    }

    public function testMethodProducts()
    {
        $this->assertInstanceOf('\Meling\Cart\Products', $this->cart->products());
    }

    public function testMethodTotals()
    {
        $this->assertInstanceOf('\Meling\Cart\Totals', $this->cart->totals());
    }

}
