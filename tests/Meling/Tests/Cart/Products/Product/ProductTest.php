<?php
namespace Meling\Tests\Cart\Providers\Products;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Products\Product\Option
     */
    protected $product;

    public function setUp()
    {
        $orm           = new \Meling\Tests\ORMStub();
        $models        = new \Meling\Cart\Providers\Models($orm);
        $array         = array();
        $session       = new \Meling\Tests\SAPIStub($array);
        $provider      = new \Meling\Cart\Providers\Provider\Session($orm, $session, -6194616, null);
        $products      = new \Meling\Cart\Products\Session($provider, $session);
        $entity        = $models->option()->load('-218981758');
        $this->product = new \Meling\Cart\Products\Product\Option($models->option(), $products, $entity, '-218981758', 1, 1000, 'shopId', 'shopTariffId', 'cityId', 'addressId', 'pvz');
    }

    public function testAddressId()
    {
        $this->assertEquals('addressId', $this->product->addressId());
    }

    public function testCityId()
    {
        $this->assertEquals('cityId', $this->product->cityId());
    }

    public function testId()
    {
        $this->assertEquals('-218981758', $this->product->id());
    }

    public function testModel()
    {
        $this->assertInstanceOf('\Meling\Cart\Providers\Models\Option', $this->product->model());
    }

    public function testPrice()
    {
        $this->assertEquals(1000, $this->product->price());
    }

    public function testPvz()
    {
        $this->assertEquals('pvz', $this->product->pvz());
    }

    public function testQuantity()
    {
        $this->assertEquals(1, $this->product->quantity());
    }

    public function testSetAddressId()
    {
        $this->product->setAddressId(18);
        $this->assertEquals(18, $this->product->addressId());
    }

    public function testSetCityId()
    {
        $this->product->setCityId(17);
        $this->assertEquals(17, $this->product->cityId());
    }

    public function testSetPrice()
    {
        $this->product->setPrice(14);
        $this->assertEquals(14, $this->product->price());
    }

    public function testSetPvz()
    {
        $this->product->setPvz('19');
        $this->assertEquals('19', $this->product->pvz());
    }

    public function testSetQuantity()
    {
        $this->product->setQuantity(13);
        $this->assertEquals(13, $this->product->quantity());
    }

    public function testSetShopId()
    {
        $this->product->setShopId(15);
        $this->assertEquals(15, $this->product->shopId());
    }

    public function testSetShopTariffId()
    {
        $this->product->setShopTariffId(16);
        $this->assertEquals(16, $this->product->shopTariffId());
    }

    public function testShopId()
    {
        $this->assertEquals('shopId', $this->product->shopId());
    }

    public function testShopTariffId()
    {
        $this->assertEquals('shopTariffId', $this->product->shopTariffId());
    }

}
