<?php
namespace Meling\Cart\Products\Product;

/**
 * Class Certificate
 * @package Meling\Cart\Products\Product
 */
class Certificate extends \Meling\Cart\Products\Product
{
    /** @var \Parishop\ORMWrappers\Certificate\Entity */
    protected $entity;

    /**
     * Certificate constructor.
     * @param \Meling\Cart\Providers\Models\Model      $model
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
     */
    public function __construct(\Meling\Cart\Providers\Models\Model $model, \Meling\Cart\Products $products, \Parishop\ORMWrappers\Certificate\Entity $certificate, $id, $quantity = 1, $price = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = '')
    {
        parent::__construct($model, $products, $certificate, $id, $quantity, $price, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
    }

    /**
     * @return \Parishop\ORMWrappers\Certificate\Entity
     */
    public function certificate()
    {
        return $this->entity;
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return $this->entity->name();
    }

    public function old_price()
    {
        return 0;
    }

}

