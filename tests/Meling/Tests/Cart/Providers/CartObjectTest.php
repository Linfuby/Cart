<?php
namespace Meling\Tests\Cart\Provider;

class CartObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\CartObject
     */
    protected $cartObject;

    public function setUp()
    {
        $option           = $this->getMock('\Meling\Cart\Wrappers\Option\Entity', array(), array(), '', false);
        $this->cartObject = new \Meling\Cart\Providers\CartObject(1, $option, 100, 2, 'image.jpg', 10, 20, 30, 40, 'pvz');
    }

    public function testAttributeCertificate()
    {
        $certificate      = $this->getMock('\Meling\Cart\Wrappers\Certificate\Entity', array(), array(), '', false);
        $this->cartObject = new \Meling\Cart\Providers\CartObject(1, $certificate, 100, 2, 'image.jpg', 10, 20, 30, 40, 'pvz');
        $this->assertAttributeInstanceOf('\Meling\Cart\Wrappers\Certificate\Entity', 'certificate', $this->cartObject);
    }

    public function testAttributeDeliveryId()
    {
        $this->assertAttributeEquals(20, 'deliveryId', $this->cartObject);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->cartObject);
    }

    public function testAttributeImage()
    {
        $this->assertAttributeEquals('image.jpg', 'image', $this->cartObject);
    }

    public function testAttributeOption()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Wrappers\Option\Entity', 'option', $this->cartObject);
    }

    public function testAttributePrice()
    {
        $this->assertAttributeEquals(100, 'price', $this->cartObject);
    }

    public function testAttributePvz()
    {
        $this->assertAttributeEquals('pvz', 'pvz', $this->cartObject);
    }

    public function testAttributeQuantity()
    {
        $this->assertAttributeEquals(2, 'quantity', $this->cartObject);
    }

    public function testAttributeShopAddressId()
    {
        $this->assertAttributeEquals(40, 'addressId', $this->cartObject);
    }

    public function testAttributeShopId()
    {
        $this->assertAttributeEquals(10, 'shopId', $this->cartObject);
    }

    public function testAttributeShopTariffId()
    {
        $this->assertAttributeEquals(30, 'shopTariffId', $this->cartObject);
    }

    public function testMethodCertificate()
    {
        $certificate      = $this->getMock('\Meling\Cart\Wrappers\Certificate\Entity', array(), array(), '', false);
        $this->cartObject = new \Meling\Cart\Providers\CartObject(1, $certificate, 100, 2, 'image.jpg', 10, 20, 30, 40, 'pvz');
        $this->assertInstanceOf('\Meling\Cart\Wrappers\Certificate\Entity', $this->cartObject->certificate());
    }

    public function testMethodCustomer()
    {
        $this->assertEquals(null, $this->cartObject->customer());
    }

    public function testMethodId()
    {
        $this->assertEquals(1, $this->cartObject->id());
    }

    public function testMethodOption()
    {
        $this->assertInstanceOf('\Meling\Cart\Wrappers\Option\Entity', $this->cartObject->option());
    }

}
