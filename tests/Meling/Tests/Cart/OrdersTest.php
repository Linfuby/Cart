<?php
namespace Meling\Tests\Cart;

class OrdersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders
     */
    protected $orders;

    protected $option1;

    protected $option2;

    protected $certificate1;

    protected $certificate2;

    public function setUp()
    {
        $this->option1      = (object)array(
            'id'           => 1,
            'option'       => null,
            'price'        => 100,
            'quantity'     => 1,
            'shopId'       => 1,
            'shopTariffId' => null,
            'addressId'    => null,
            'pvz'          => 'pvz1',
        );
        $this->option2      = (object)array(
            'id'           => 2,
            'option'       => null,
            'price'        => 200,
            'quantity'     => 2,
            'shopId'       => 2,
            'shopTariffId' => 2,
            'addressId'    => 2,
            'pvz'          => 'pvz2',
        );
        $this->certificate1 = (object)array(
            'id'           => 1,
            'certificate'  => null,
            'image'        => 'image1.jpg',
            'price'        => 100,
            'quantity'     => 1,
            'shopId'       => 1,
            'shopTariffId' => null,
            'addressId'    => null,
            'pvz'          => 'pvz1',
        );
        $this->certificate2 = (object)array(
            'id'           => 2,
            'certificate'  => null,
            'image'        => 'image2.jpg',
            'price'        => 200,
            'quantity'     => 2,
            'shopId'       => 2,
            'shopTariffId' => 2,
            'addressId'    => 2,
            'pvz'          => 'pvz2',
        );
        /**
         * @var \Meling\Cart\Customer          $customer
         * @var \Meling\Cart\Provider\Customer $provider
         */
        $customer     = $this->getMock('\Meling\Cart\Customer', array(), array(), '', false);
        $data         = array();
        $provider     = new \Meling\Cart\Provider\Custom(
            new \Meling\Cart\Provider\Guest(new \Meling\Tests\Cart\Provider\SAPIStub($data)),
            array($this->option1, $this->option2),
            array($this->certificate1, $this->certificate2)
        );
        $this->orders = new \Meling\Cart\Orders($customer, $provider);
    }

    public function testAttributeCustomer()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Customer', 'customer', $this->orders);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Provider\Custom', 'provider', $this->orders);
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->orders->asArray());
    }

    public function testMethodDefaultOrder()
    {
        $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->defaultOrder());
    }

    public function testMethodGet()
    {
        $this->orders->asArray();
        $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->get(0));
    }

    /**
     * @expectedException \Exception
     */
    public function testMethodGetThrow()
    {
        $this->orders->asArray();
        $this->assertInstanceOf('\Meling\Cart\Orders\Order', $this->orders->get(null));
    }

}
