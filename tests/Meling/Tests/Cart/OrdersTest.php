<?php
namespace Meling\Tests\Cart;

class OrdersTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Meling\Cart\Orders */
    protected $orders;

    public function setUp()
    {
        /** @var \PHPixie\ORM $orm */
        $orm = $this->getMock('\PHPixie\ORM', array(), array(), '', false);
        /** @var \PHPixie\HTTP\Context $context */
        $context = $this->getMock('\PHPixie\HTTP\Context', array(), array(), '', false);
        $shop    = $this->getMock('\PHPixie\ORM\Wrappers\Type\Database\Entity', array(), array(), '', false);
        $shop->expects($this->any())
            ->method('getRequiredField')
            ->will($this->returnValue('111'));
        $shop->expects($this->any())
            ->method('id')
            ->will($this->returnValue('1'));
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $shop */
        $point1     = new \Meling\Cart\Points\Point\Shop($shop, array());
        $product1   = new \Meling\Cart\Products\Option(1, null, 1, 100, $point1);
        $shopTariff = $this->getMock('\PHPixie\ORM\Wrappers\Type\Database\Entity', array(), array(), '', false);
        $shopTariff->expects($this->any())
            ->method('id')
            ->will($this->returnValue('222'));
        $shopTariff->expects($this->any())
            ->method('getRequiredField')
            ->will($this->returnValue('333'));
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $shopTariff */
        $point2       = new \Meling\Cart\Points\Point\Delivery($shop, $shopTariff, 'Test');
        $product2     = new \Meling\Cart\Products\Certificate(2, null, 2, 200, $point2);
        $provider     = new \Meling\Cart\Providers\Custom($orm, $context, new \Meling\Cart\Providers\Products\Options(array($product1)), new \Meling\Cart\Providers\Products\Certificates(array($product2)));
        $products     = new \Meling\Cart\Products($provider);
        $this->orders = new \Meling\Cart\Orders($products);
    }

    public function testMethodAsArray()
    {
        foreach($this->orders->asArray() as $order) {
            $this->assertInstanceOf('\Meling\Cart\Orders\Order', $order);
        }
    }

    public function testMethodCount()
    {
        $this->assertEquals(2, $this->orders->count());
    }

    public function testMethodGet()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->get(1));
    }


}
