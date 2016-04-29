<?php
namespace Meling\Tests\Cart\Points\Tariffs\Deliveries;

class PostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Points\Tariffs\Deliveries\Post
     */
    protected $deliveryPost;

    protected $name;

    protected $fullName;

    protected $cost;

    public function setUp()
    {
        $orm = new \Meling\Tests\ORM();
        /** @var \Meling\Tests\ORMWrappers\Entities\Delivery $delivery */
        $delivery   = $orm->query('delivery')->where('alias', 'post')->findOne();
        $this->name = $delivery->getField('name');
        /** @var \Meling\Tests\ORMWrappers\Entities\ShopTariff $defaultTariff */
        $defaultTariff  = $delivery->shopTariffs()->getByOffset(0);
        $this->cost     = $defaultTariff->getField('cost');
        $this->fullName = $this->name . ' (' . $defaultTariff->getField('name') . ')';
        $orm->disconnect();
        $this->deliveryPost = new \Meling\Cart\Points\Tariffs\Deliveries\Post($delivery, $delivery->shopTariffs(), $defaultTariff);
    }

    public function testAttributeDefaultTariff()
    {
        $this->assertAttributeInstanceOf('\Meling\Tests\ORMWrappers\Entities\ShopTariff', 'defaultTariff', $this->deliveryPost);
    }

    public function testAttributeDelivery()
    {
        $this->assertAttributeInstanceOf('\Meling\Tests\ORMWrappers\Entities\Delivery', 'delivery', $this->deliveryPost);
    }

    public function testMethodCalculate()
    {
        $this->assertEquals($this->cost, $this->deliveryPost->calculate());
    }

    public function testMethodDefaultTariff()
    {
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\ShopTariff', $this->deliveryPost->defaultTariff());
    }

    public function testMethodFullName()
    {
        $this->assertEquals($this->fullName, $this->deliveryPost->fullName());
    }

    public function testMethodName()
    {
        $this->assertEquals($this->name, $this->deliveryPost->name());
    }

}
