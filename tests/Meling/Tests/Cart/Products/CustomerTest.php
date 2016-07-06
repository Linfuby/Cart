<?php
namespace Meling\Tests\Cart\Providers\Products;

class CustomerTest extends \PHPixie\Test\Testcase
{
    /**
     * @var \Meling\Cart\Products\Customer
     */
    protected $customer;

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
        /** @var \Parishop\ORMWrappers\Customer\Entity $customer */
        $customer       = $orm->query('customer')->findOne();
        $provider       = new \Meling\Cart\Providers\Provider\Customer($orm, $customer, -6194616, null);
        $this->customer = new \Meling\Cart\Products\Customer($provider, $customer);
        $this->customer->clear();
        $this->customer->addOption($this->option1['id'], $this->option1['quantity'], $this->option1['price']);
    }

    public function testAddCertificate()
    {
        $this->assertEquals(1, $this->customer->count());
        $this->customer->addCertificate($this->certificate1['id'], $this->certificate1['quantity'], $this->certificate1['price']);
        $this->assertEquals(2, $this->customer->count());
    }

    public function testAddOption()
    {
        $this->customer->addOption($this->option2['id'], $this->option2['quantity'], $this->option2['price']);
        $this->assertEquals(2, $this->customer->count());
    }

    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('\Parishop\ORMWrappers\Customer\Entity', 'customer', $this->customer);
    }

    public function testClear()
    {
        $this->customer->clear();
        $options = $certificates = [];
        $this->assertEquals($options, $this->customer->entity()->cartOptions()->asArray(true));
        $this->assertEquals($certificates, $this->customer->entity()->cartCertificates()->asArray(true));
    }

    public function testRemoveCertificate()
    {
        $this->customer->addCertificate($this->certificate1['id'], $this->certificate1['quantity'], $this->certificate1['price']);
        $this->customer->remove($this->certificate1['id']);
        $this->assertEquals(1, $this->customer->count());
    }

    public function testRemoveOption()
    {
        $this->customer->addOption($this->option2['id'], $this->option2['quantity'], $this->option2['price']);
        $this->customer->remove($this->option1['id']);
        $this->assertEquals(1, $this->customer->count());
    }

}
