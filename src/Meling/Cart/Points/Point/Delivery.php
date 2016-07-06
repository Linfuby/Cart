<?php
namespace Meling\Cart\Points\Point;

/**
 * Class Delivery
 * @property string deliveryId
 * @property string shopId
 * @package Meling\Cart\Points\Point
 */
class Delivery extends \Meling\Cart\Points\Point
{
    public    $shopTariffId;

    /** @var \Parishop\ORMWrappers\Delivery\Entity */
    protected $delivery;

    /** @var \Parishop\ORMWrappers\ShopTariff\Entity */
    protected $shopTariff;

    /**
     * Delivery constructor.
     * @param mixed                                   $id
     * @param \Parishop\ORMWrappers\ShopTariff\Entity $shopTariff
     */
    public function __construct($id, \Parishop\ORMWrappers\ShopTariff\Entity $shopTariff)
    {
        parent::__construct($id);
        $this->delivery     = $shopTariff->delivery();
        $this->shopTariff   = $shopTariff;
        $this->shopTariffId = $shopTariff->id();
    }

    /**
     * @param string $name
     * @return string
     */
    function __get($name)
    {
        return $this->shopTariff->{$name};
    }

    public function alias()
    {
        return $this->delivery->alias;
    }

    public function cost()
    {
        return $this->shopTariff->cost;
    }

    public function name()
    {
        return $this->delivery->name();
    }

    public function nameCity()
    {
        return $this->delivery->name() . ' (' . $this->shopTariff->name() . ')';
    }

    public function nameFull()
    {
        return $this->nameCity();
    }

    public function shopTariff()
    {
    }

}

