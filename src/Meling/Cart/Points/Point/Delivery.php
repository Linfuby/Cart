<?php
namespace Meling\Cart\Points\Point;

class Delivery extends \Meling\Cart\Points\Point\Implementation
{
    /**
     * @var string
     */
    public $alias;

    /**
     * @var \Parishop\ORMWrappers\Shop\Entity
     */
    protected $shop;

    /**
     * @var \Parishop\ORMWrappers\ShopTariff\Entity
     */
    protected $shopTariff;

    /**
     * Implementation constructor.
     * @param string                                  $id
     * @param string                                  $name
     * @param string                                  $alias
     * @param \Parishop\ORMWrappers\Shop\Entity       $shop
     * @param \Parishop\ORMWrappers\ShopTariff\Entity $shopTariff
     * @param string                                  $cityId
     */
    public function __construct($id, $name, $alias, $shop, $shopTariff, $cityId = null)
    {
        parent::__construct($id, $name, $cityId);
        $this->alias      = $alias;
        $this->shop       = $shop;
        $this->shopTariff = $shopTariff;
    }

    public function cost()
    {
        return $this->shopTariff->cost;
    }

    public function delivery()
    {
        return $this->shopTariff->delivery();
    }

    public function shop()
    {
        return $this->shop;
    }

    public function shopTariff()
    {
        return $this->shopTariff;
    }


}
