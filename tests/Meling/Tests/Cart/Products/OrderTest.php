<?php
namespace Meling\Tests\Cart\Providers\Products;

class OrderTest extends \PHPixie\Test\Testcase
{
    /**
     * @var \Meling\Cart\Products\Order
     */
    protected $order;

    protected $option1      = array(
        'id'           => '-169235494',
        'quantity'     => 1,
        'price'        => 1250,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    protected $option2      = array(
        'id'           => '-169235492',
        'quantity'     => 2,
        'price'        => 1520,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    protected $certificate1 = array(
        'id'           => '147409994001',
        'quantity'     => 1,
        'price'        => 1500,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    public function setUp()
    {
        $orm = new \Meling\Tests\ORMStub();
        /** @var \Parishop\ORMWrappers\Order\Entity $order */
        $order       = $orm->query('order')->findOne();
        $provider    = new \Meling\Cart\Providers\Provider\Order($orm, $order, -6194616, null);
        $this->order = new \Meling\Cart\Products\Order($provider, $order);
        $this->order->clear();
        $this->order->addOption($this->option1['id'], $this->option1['quantity'], $this->option1['price']);
    }

    public function testAddCertificate()
    {
        $this->assertEquals(1, $this->order->count());
        $this->order->addCertificate($this->certificate1['id'], $this->certificate1['quantity'], $this->certificate1['price']);
        $this->assertEquals(2, $this->order->count());
    }

    public function testAddOption()
    {
        $this->order->addOption($this->option2['id'], $this->option2['quantity'], $this->option2['price']);
        $this->assertEquals(2, $this->order->count());
    }

    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('\Parishop\ORMWrappers\Order\Entity', 'order', $this->order);
    }

    public function testClear()
    {
        $this->order->clear();
        $options = $certificates = [];
        $this->assertEquals($options, $this->order->entity()->orderOptions()->asArray(true));
        $this->assertEquals($certificates, $this->order->entity()->orderCertificates()->asArray(true));
    }

    public function testRemoveCertificate()
    {
        $this->order->addCertificate($this->certificate1['id'], $this->certificate1['quantity'], $this->certificate1['price']);
        $this->order->remove($this->certificate1['id']);
        $this->assertEquals(1, $this->order->count());
    }

    public function testRemoveOption()
    {
        $this->order->addOption($this->option2['id'], $this->option2['quantity'], $this->option2['price']);
        $this->order->remove($this->option1['id']);
        $this->assertEquals(1, $this->order->count());
    }

}
