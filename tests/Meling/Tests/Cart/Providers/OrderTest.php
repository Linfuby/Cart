<?php
namespace Meling\Tests\Cart\Providers;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Order
     */
    protected $order;

    public static function getOrder($id = null, $data = array())
    {
        $source = \Meling\Tests\Cart\SourceTest::getSource();
        $orders = $source->query('order');
        if($id) {
            $orders->in($id);
        }
        /**
         * @var \Parishop\ORMWrappers\Order\Entity $order
         */
        $order = $orders->findOnePreload();
        foreach($data as $key => $value) {
            if(is_array($value)) {
                foreach($value as $k => $v) {
                    $order->{$key}()->setField($k, $v);
                }
            } else {
                $order->setField($key, $value);
            }
        }
        $source = \Meling\Tests\Cart\SourceTest::getSource(array(), null, $order->action());

        return new \Meling\Cart\Providers\Order($source, $order);
    }

    public function setUp()
    {
        $cart        = \Meling\Tests\CartTest::getCartOrder();
        $this->order = $cart->builder()->context()->provider();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
    }

    public function testAttributeOrder()
    {
        $this->assertAttributeInstanceOf('\Parishop\ORMWrappers\Order\Entity', 'order', $this->order);
    }

    public function testAttributeSource()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Source', 'source', $this->order);
    }

    public function testMethodCards()
    {
        $this->assertInternalType('array', $this->order->cards());
    }

    public function testMethodCertificates()
    {
        $this->assertInternalType('array', $this->order->certificates());
    }

    public function testMethodDateActual()
    {
        $date  = date('Y-m-d H:i:s');
        $order = $this->getOrder(null, array('created' => $date));
        $this->assertEquals(new \DateTime($date), $order->dateActual());
    }

    public function testMethodDateBirthday()
    {
        $order = $this->getOrder(null, array('customer' => array('birthday' => null)));
        $this->assertNull($order->dateBirthday());
        $order = $this->getOrder(null, array('customer' => array('birthday' => '0000-00-00')));
        $this->assertNull($order->dateBirthday());
        $order = $this->getOrder(
            null, array('customer' => array('birthday' => '1983-03-10', 'birthday_use' => date('Y-m-d')))
        );
        $this->assertNull($order->dateBirthday());
        $order = $this->getOrder(null, array('customer' => array('birthday' => '1983-03-10', 'birthday_use' => null)));
        $this->assertEquals(new \DateTime('1983-03-10'), $order->dateBirthday());
        $order = $this->getOrder(
            null, array('customer' => array('birthday' => '1983-03-10', 'birthday_use' => '2015-03-10'))
        );
        $this->assertEquals(new \DateTime('1983-03-10'), $order->dateBirthday());
    }

    public function testMethodDateMarriage()
    {
        $order = $this->getOrder(null, array('customer' => array('marriage' => null)));
        $this->assertNull($order->dateMarriage());
        $order = $this->getOrder(null, array('customer' => array('marriage' => '0000-00-00')));
        $this->assertNull($order->dateMarriage());
        $order = $this->getOrder(
            null, array('customer' => array('marriage' => '1983-03-10', 'marriage_use' => date('Y-m-d')))
        );
        $this->assertNull($order->dateMarriage());
        $order = $this->getOrder(null, array('customer' => array('marriage' => '1983-03-10', 'marriage_use' => null)));
        $this->assertEquals(new \DateTime('1983-03-10'), $order->dateMarriage());
        $order = $this->getOrder(
            null, array('customer' => array('marriage' => '1983-03-10', 'marriage_use' => '2015-03-10'))
        );
        $this->assertEquals(new \DateTime('1983-03-10'), $order->dateMarriage());
    }

    public function testMethodMagicCall()
    {
        $this->assertInternalType('string', $this->order->name());
    }

    public function testMethodMagicGet()
    {
        $this->assertInternalType('string', $this->order->id);
    }

    public function testMethodProducts()
    {
        $this->assertInternalType('array', $this->order->products());
    }

}
