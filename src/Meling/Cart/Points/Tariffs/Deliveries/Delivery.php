<?php
namespace Meling\Cart\Points\Tariffs\Deliveries;

abstract class Delivery
{
    /**
     * @var \Meling\Tests\ORMWrappers\Entities\ShopTariff[]
     */
    protected $tariffs;

    /**
     * @var \Meling\Tests\ORMWrappers\Entities\ShopTariff
     */
    protected $defaultTariff;

    /**
     * @var \Meling\Tests\ORMWrappers\Entities\Delivery
     */
    private $delivery;

    /**
     * @var string
     */
    private $name;

    /**
     * Delivery constructor.
     * @param \Meling\Tests\ORMWrappers\Entities\Delivery     $delivery
     * @param \Meling\Tests\ORMWrappers\Entities\ShopTariff[] $tariffs
     * @param \Meling\Tests\ORMWrappers\Entities\ShopTariff   $defaultTariff
     */
    public function __construct($delivery, $tariffs, $defaultTariff)
    {
        $this->delivery      = $delivery;
        $this->tariffs       = $tariffs;
        $this->defaultTariff = $defaultTariff;
    }

    public function calculate()
    {
        return $this->defaultTariff()->calculate();
    }

    /**
     * @return \Meling\Tests\ORMWrappers\Entities\ShopTariff
     */
    public function defaultTariff()
    {
        return $this->defaultTariff;
    }

    /**
     * @return string
     */
    public function fullName()
    {
        return $this->name() . ' (' . $this->defaultTariff()->getRequiredField('name') . ')';
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->delivery->getRequiredField('name');
    }

}
