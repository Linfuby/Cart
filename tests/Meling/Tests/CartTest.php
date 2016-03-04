<?php
namespace Meling\Tests;

/**
 * Class CartOptionsTest
 * @package Meling\Tests
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart
     */
    protected $cart;

    public static function getCustomerCertificatesCart($data = array())
    {
        $slice       = new \PHPixie\Slice();
        $subject     = new \Meling\Cart\Providers\Subjects\Customer();
        $objects     = new \Meling\Cart\Providers\Objects\Certificates();
        $environment = new \Meling\Cart\Providers\Environments\Environment(
            $slice->editableArrayData($data), \Meling\Tests\CartTest::getORM()->repositories()
        );

        return new \Meling\Cart($subject, $objects, $environment);
    }

    public static function getCustomerOptionsCart($data = array())
    {
        $slice       = new \PHPixie\Slice();
        $subject     = new \Meling\Cart\Providers\Subjects\Customer();
        $objects     = new \Meling\Cart\Providers\Objects\Options();
        $environment = new \Meling\Cart\Providers\Environments\Environment(
            $slice->editableArrayData($data), \Meling\Tests\CartTest::getORM()->repositories()
        );

        return new \Meling\Cart($subject, $objects, $environment);
    }

    public static function getGuestCertificatesCart($data = array())
    {
        $slice       = new \PHPixie\Slice();
        $subject     = new \Meling\Cart\Providers\Subjects\Session();
        $objects     = new \Meling\Cart\Providers\Objects\Certificates();
        $environment = new \Meling\Cart\Providers\Environments\Environment(
            $slice->editableArrayData($data), \Meling\Tests\CartTest::getORM()->repositories()
        );

        return new \Meling\Cart($subject, $objects, $environment);
    }

    public static function getGuestOptionsCart($data = array())
    {
        $slice       = new \PHPixie\Slice();
        $subject     = new \Meling\Cart\Providers\Subjects\Session();
        $objects     = new \Meling\Cart\Providers\Objects\Options();
        $environment = new \Meling\Cart\Providers\Environments\Environment(
            $slice->editableArrayData($data), \Meling\Tests\CartTest::getORM()->repositories()
        );

        return new \Meling\Cart($subject, $objects, $environment);
    }

    public static function getORM()
    {
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

        return new \PHPixie\ORM($database, $slice->arrayData(array()));
    }

    public static function getOrderProductsCart($data = array())
    {
        $slice       = new \PHPixie\Slice();
        $subject     = new \Meling\Cart\Providers\Subjects\Order();
        $objects     = new \Meling\Cart\Providers\Objects\Products();
        $environment = new \Meling\Cart\Providers\Environments\Environment(
            $slice->editableArrayData($data), \Meling\Tests\CartTest::getORM()->repositories()
        );

        return new \Meling\Cart($subject, $objects, $environment);
    }

    public function setUp()
    {

        $this->cart = \Meling\Tests\CartTest::getCustomerOptionsCart();
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
