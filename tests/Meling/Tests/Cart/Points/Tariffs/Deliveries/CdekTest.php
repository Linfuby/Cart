<?php
namespace Meling\Tests\Cart\Points\Tariffs\Deliveries;

class CdekTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Points\Tariffs\Deliveries\Cdek
     */
    protected $deliveryCdek;

    protected $name;

    protected $fullName;

    protected $cost;

    public function setUp()
    {
        $orm = new \Meling\Tests\ORM();
        /** @var \Meling\Tests\ORMWrappers\Entities\Delivery $delivery */
        $delivery   = $orm->query('delivery')->where('alias', 'cdek')->findOne();
        $this->name = $delivery->getField('name');
        /** @var \Meling\Tests\ORMWrappers\Entities\ShopTariff $defaultTariff */
        $defaultTariff  = $delivery->shopTariffs()->getByOffset(0);
        $this->cost     = $defaultTariff->getField('cost');
        $this->fullName = $this->name . ' (' . $defaultTariff->getField('name') . ')';
        $orm->disconnect();
        $this->deliveryCdek = new \Meling\Cart\Points\Tariffs\Deliveries\Cdek($delivery, $delivery->shopTariffs(), $defaultTariff);
    }

    public function testAttributeDefaultTariff()
    {
        $this->assertAttributeInstanceOf('\Meling\Tests\ORMWrappers\Entities\ShopTariff', 'defaultTariff', $this->deliveryCdek);
    }

    public function testAttributeDelivery()
    {
        $this->assertAttributeInstanceOf('\Meling\Tests\ORMWrappers\Entities\Delivery', 'delivery', $this->deliveryCdek);
    }

    public function testMethodCalculate()
    {
        $this->assertEquals($this->cost, $this->deliveryCdek->calculate());
    }

    public function testMethodDefaultTariff()
    {
        $this->assertInstanceOf('\Meling\Tests\ORMWrappers\Entities\ShopTariff', $this->deliveryCdek->defaultTariff());
    }

    public function testMethodFullName()
    {
        $this->assertEquals($this->fullName, $this->deliveryCdek->fullName());
    }

    public function testMethodName()
    {
        $this->assertEquals($this->name, $this->deliveryCdek->name());
    }

}
