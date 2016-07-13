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
    public $shopTariffId;

    /** @var \Parishop\ORMWrappers\Delivery\Entity */
    protected $delivery;

    /** @var \Parishop\ORMWrappers\ShopTariff\Entity */
    protected $shopTariff;

    /** @var string */
    protected $pvz;

    /**
     * Delivery constructor.
     * @param mixed                                   $id
     * @param \Parishop\ORMWrappers\ShopTariff\Entity $shopTariff
     * @param string                                  $pvz
     */
    public function __construct($id, \Parishop\ORMWrappers\ShopTariff\Entity $shopTariff, $pvz)
    {
        parent::__construct($id);
        $this->delivery     = $shopTariff->delivery();
        $this->shopTariff   = $shopTariff;
        $this->shopTariffId = $shopTariff->id();
        $this->pvz          = $pvz;
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
        return $this->delivery->name() . ' (' . $this->pvz . ')';
    }

    public function shopTariff()
    {
    }

}

