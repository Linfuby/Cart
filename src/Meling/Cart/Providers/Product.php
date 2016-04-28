<?php
namespace Meling\Cart\Providers;

/**
 * Class Product
 * @package Meling\Cart\Providers
 */
class Product
{
    public $id;

    public $entity;

    public $quantity;

    public $price;

    public $shopId;

    public $shopTariffId;

    public $addressId;

    /**
     * Product constructor.
     * @param $id
     * @param $entity
     * @param $quantity
     * @param $price
     * @param $shopId
     * @param $shopTariffId
     * @param $addressId
     */
    public function __construct($id, $entity, $quantity, $price, $shopId = null, $shopTariffId = null, $addressId = null)
    {
        $this->id           = $id;
        $this->entity       = $entity;
        $this->quantity     = $quantity;
        $this->price        = $price;
        $this->shopId       = $shopId;
        $this->shopTariffId = $shopTariffId;
        $this->addressId    = $addressId;
    }

}
