<?php
namespace Meling\Tests\Cart\Providers;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public static function getOrder($id = null, $data = array())
    {
        $orm    = \Meling\Tests\CartTest::getORM();
        $source    = \Meling\Tests\Cart\SourceTest::getSource();
        $orders = $orm->query('order');
        if($id) {
            $orders->in($id);
        }
        $order = $orders->findOne();
        foreach($data as $key => $value) {
            if(is_array($value)) {
                foreach($value as $k => $v) {
                    $order->{$key}()->setField($k, $v);
                }
            } else {
                $order->setField($key, $value);
            }
        }

        return new \Meling\Cart\Providers\Order($source, $order);
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getORM()->builder()->database()->connection('default')->disconnect();
    }

    public function testAttributeOrder()
    {
        $order = $this->getOrder();
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'order', $order);
    }

    public function testAttributeSource()
    {
        $order = $this->getOrder();
        $this->assertAttributeInstanceOf('\Meling\Cart\Source', 'source', $order);
    }

    public function testMethodCards()
    {
        $order = $this->getOrder();
        $this->assertInternalType('array', $order->cards());
    }

    public function testMethodCertificates()
    {
        $order = $this->getOrder();
        $this->assertInternalType('array', $order->certificates());
    }

    public function testMethodDateActual()
    {
        $order = $this->getOrder(null, array('created' => date('Y-m-d H:i:s')));
        $this->assertEquals(new \DateTime(), $order->dateActual());
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
        $order = $this->getOrder();
        $this->assertInternalType('string', $order->id());
    }

    public function testMethodMagicGet()
    {
        $order = $this->getOrder();
        $this->assertInternalType('string', $order->id);
    }

    public function testMethodProducts()
    {
        $order = $this->getOrder();
        $this->assertInternalType('array', $order->products());
    }

}
