<?php
namespace Meling\Cart\Points\Tariffs\Deliveries;

abstract class Delivery
{
    /**
     * @var \Meling\Cart\Points\Tariffs\Tariff
     */
    private $tariff;

    /**
     * @var string
     */
    private $name;

    /**
     * Delivery constructor.
     * @param string                             $name
     * @param \Meling\Tests\ORMWrappers\Entities\ShopTariff $shopTariff
     */
    public function __construct($name, $tariff)
    {
        $this->tariff = $tariff;
        $this->name   = $name;
    }

    public function calculate()
    {
        return $this->tariff()->calculate();
    }

    /**
     * @return string
     */
    public function fullName()
    {
        return $this->name . ' (' . $this->tariff()->name() . ')';
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return \Meling\Cart\Points\Tariffs\Tariff
     */
    public function tariff()
    {
        return $this->tariff;
    }

}
