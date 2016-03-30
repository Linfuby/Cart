<?php
namespace Meling\Cart\Provider;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Provider\Order
     */
    protected $provider;

    public static function getProvider($id = null, $data = array())
    {
        $orm = \Meling\CartTest::getORM();
        /**
         * @var \Meling\Cart\Wrappers\Order\Entity $order
         */
        $orders = $orm->query('order');
        if($id !== null) {
            $orders->in($id);
        }
        $order = $orders->findOne(
            array(
                'orderCertificates',
                'orderCertificates.certificate',
                'orderProducts',
                'orderProducts.option',
            )
        );
        foreach($data as $name => $value) {
            $order->setField($name, $value);
        }

        return new \Meling\Cart\Provider\Order($order);
    }

    public function setUp()
    {
        $this->provider = $this->getProvider();
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeOrder()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Wrappers\Order\Entity', 'order', $this->provider);
    }

    public function testMethodObjects()
    {
        $this->assertInstanceOf('\Meling\Cart\Objects', $this->provider->objects());
    }

}
