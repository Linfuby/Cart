<?php
namespace Meling\Cart\Products;

/**
 * Class Option
 * @property string par
 * @method string image()
 * @method string name()
 * @method string url()
 * @method \Parishop\ORMWrappers\Brand\Entity brand()
 * @method \Parishop\ORMWrappers\MainColor\Entity mainColor()
 * @package Meling\Cart\Products
 */
class Option extends Product
{
    /**
     * @var \Parishop\ORMWrappers\Option\Entity
     */
    protected $option;

    /**
     * Product constructor.
     * @param string                              $id
     * @param \Parishop\ORMWrappers\Option\Entity $option
     * @param int                                 $quantity
     * @param int                                 $price
     * @param \Meling\Cart\Points                 $points
     * @param string                              $pointId
     * @param string                              $shopId
     * @param string                              $shopTariffId
     * @param \Parishop\ORMWrappers\City\Entity   $city
     * @param string                              $cityId
     * @param string                              $addressId
     * @param string                              $pvz
     */
    public function __construct($id, $option, $quantity, $price, \Meling\Cart\Points $points, $pointId = null, $shopId = null, $shopTariffId = null, $city = null, $cityId = null, $addressId = null, $pvz = null)
    {
        parent::__construct($id, $quantity, $price, $points, $pointId, $shopId, $shopTariffId, $city, $cityId, $addressId, $pvz);
        $this->option = $option;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->option->product()->$name($arguments);
    }

    /**
     * @param $name
     * @return string
     */
    public function __get($name)
    {
        return $this->option->product()->$name;
    }

    /**
     * @return \Parishop\ORMWrappers\Action\Entity
     */
    public function action()
    {
        return $this->option->action();
    }

    public function old_price()
    {
        return ($this->option->special && $this->option->old_price > $this->option->price) ? $this->option->old_price : 0;
    }

    public function option()
    {
        return $this->option;
    }

    public function sizeName()
    {
        return $this->option->sizeName();
    }


}
