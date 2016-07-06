<?php
namespace Meling\Cart\Providers\Models;

/**
 * Class Certificate
 * @method \Parishop\ORMWrappers\Certificate\Entity load($id)
 * @package Meling\Cart\Providers\Models
 */
class Certificate extends Model
{
    protected $modelName = 'certificate';

    /**
     * @param \Meling\Cart\Products                    $products
     * @param \Parishop\ORMWrappers\Certificate\Entity $certificate
     * @param mixed                                    $id
     * @param int                                      $quantity
     * @param int                                      $price
     * @param mixed                                    $shopId
     * @param mixed                                    $shopTariffId
     * @param mixed                                    $cityId
     * @param mixed                                    $addressId
     * @param string                                   $pvz
     * @return \Meling\Cart\Products\Product
     */
    public function buildProduct($products, $certificate, $id, $quantity = 1, $price = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = '')
    {
        return new \Meling\Cart\Products\Product\Certificate($this, $products, $certificate, $id, $quantity, $price, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
    }

    /**
     * @return string
     */
    public function modelName()
    {
        return $this->modelName;
    }

}

