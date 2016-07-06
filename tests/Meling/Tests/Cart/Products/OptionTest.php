<?php
namespace Meling\Tests\Cart\Products;


class ProductTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Meling\Cart\Products\Option */
    protected $option;

    public function setUp()
    {
        /** @var \PHPixie\ORM\Models\Model\Entity $entity */
        $entity       = $this->getMockForAbstractClass('PHPixie\ORM\Models\Model\Entity', array(), '', false, false, true, array());
        $entity       = new \PHPixie\ORM\Wrappers\Type\Database\Entity($entity);
        $this->option = new \Meling\Cart\Products\Option($entity, 1, 1000, 'shopId', 'shopTariffId', 'cityId', 'addressId', 'pvz');
    }

    public function testAttributeEntity()
    {
        $this->assertAttributeInstanceOf('PHPixie\ORM\Models\Model\Entity', 'entity', $this->option);
    }

    public function testAttributeQty()
    {
        $this->assertAttributeEquals(1, 'quantity', $this->option);
    }

    public function testAttributePrice()
    {
        $this->assertAttributeEquals(1000, 'price', $this->option);
    }

    public function testAttributeShopId()
    {
        $this->assertAttributeEquals('shopId', 'shopId', $this->option);
    }

    public function testAttributeShopTariffId()
    {
        $this->assertAttributeEquals('shopTariffId', 'shopTariffId', $this->option);
    }

    public function testAttributeCityId()
    {
        $this->assertAttributeEquals('cityId', 'cityId', $this->option);
    }

    public function testAttributeAddressId()
    {
        $this->assertAttributeEquals('addressId', 'addressId', $this->option);
    }

    public function testAttributePvz()
    {
        $this->assertAttributeEquals('pvz', 'pvz', $this->option);
    }

    public function testOption()
    {
        $this->assertInstanceOf('PHPixie\ORM\Models\Model\Entity', $this->option->option());
    }

    public function testQty()
    {
        $this->assertEquals(1, $this->option->quantity());
    }

    public function testPrice()
    {
        $this->assertEquals(1000, $this->option->price());
    }

    public function testShopId()
    {
        $this->assertEquals('shopId', $this->option->shopId());
    }

    public function testShopTariffId()
    {
        $this->assertEquals('shopTariffId', $this->option->shopTariffId());
    }

    public function testCityId()
    {
        $this->assertEquals('cityId', $this->option->cityId());
    }

    public function testAddressId()
    {
        $this->assertEquals('addressId', $this->option->addressId());
    }

    public function testPvz()
    {
        $this->assertEquals('pvz', $this->option->pvz());
    }

    public function testRests()
    {
        $this->assertInstanceOf('PHPixie\ORM\Loaders\Loader\Proxy\Editable', $this->option->rests());
    }

}
