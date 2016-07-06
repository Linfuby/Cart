<?php
namespace Meling\Cart\Providers\Models;

/**
 * Class Option
 * @method \Parishop\ORMWrappers\Option\Entity load($id)
 * @package Meling\Cart\Providers\Models
 */
class Option extends Model
{
    protected $modelName = 'option';

    /**
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
     * @return \Meling\Cart\Products\Product
     */
    public function buildProduct($products, $option, $id, $quantity = 1, $price = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = '')
    {
        return new \Meling\Cart\Products\Product\Option($this, $products, $option, $id, $quantity, $price, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
    }

    /**
     * @return string
     */
    public function modelName()
    {
        return $this->modelName;
    }

}

