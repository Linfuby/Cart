<?php
namespace Meling\Cart\Products\Product;

/**
 * Class Option
 * @property string par
 * @package Meling\Cart\Products\Product
 */
class Option extends \Meling\Cart\Products\Product
{
    /** @var \Parishop\ORMWrappers\Option\Entity */
    protected $entity;

    /**
     * Option constructor.
     * @param \Meling\Cart\Providers\Models\Model $model
     * @param \Meling\Cart\Products               $products
     * @param \Parishop\ORMWrappers\Option\Entity $option
     * @param mixed                               $id
     * @param int                                 $quantity
     * @param int                                 $price
     * @param mixed                               $shopId
     * @param mixed                               $shopTariffId
     * @param mixed                               $cityId
     * @param mixed                               $addressId
     * @param string                              $pvz
     */
    public function __construct(\Meling\Cart\Providers\Models\Model $model, \Meling\Cart\Products $products, \Parishop\ORMWrappers\Option\Entity $option, $id, $quantity = 1, $price = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = '')
    {
        parent::__construct($model, $products, $option, $id, $quantity, $price, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
    }

    /**
     * @param string $name
     * @return string
     */
    function __get($name)
    {
        return $this->entity->product()->{$name};
    }

    public function brandName()
    {
        return $this->entity->product()->brand()->name();
    }

    public function image()
    {
        return $this->entity->product()->image();
    }

    public function mainColorName()
    {
        return $this->entity->product()->mainColor()->name();
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return $this->entity->product()->name();
    }

    public function old_price()
    {
        return $this->entity->old_price;
    }

    /**
     * @return \Parishop\ORMWrappers\Option\Entity
     */
    public function option()
    {
        return $this->entity;
    }

    public function sizeName()
    {
        return $this->entity->sizeName();
    }

    public function url()
    {
        return $this->entity->product()->url();
    }

}

