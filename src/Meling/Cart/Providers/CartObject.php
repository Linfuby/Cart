<?php
namespace Meling\Cart\Providers;

/**
 * Провайдер
 * Class Provider
 * @package Meling\Cart
 */
class CartObject
{
    public    $id;

    public    $certificateId;

    public    $optionId;

    public    $price;

    public    $quantity;

    public    $image;

    public    $shopId;

    public    $deliveryId;

    public    $shopTariffId;

    public    $addressId;

    public    $pvz;

    protected $certificate;

    protected $option;

    protected $customer;

    /**
     * CartObject constructor.
     * @param                              $id
     * @param \Meling\Cart\Wrappers\Entity $entity
     * @param                              $price
     * @param                              $quantity
     * @param                              $image
     * @param                              $shopId
     * @param                              $deliveryId
     * @param                              $shopTariffId
     * @param                              $addressId
     * @param                              $pvz
     * @param                              $customer
     */
    public function __construct($id, $entity, $price, $quantity, $image, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz, $customer = null)
    {
        $this->id = $id;
        if($entity instanceof \Meling\Cart\Wrappers\Option\Entity) {
            $this->option = $entity;
        }
        if($entity instanceof \Meling\Cart\Wrappers\Certificate\Entity) {
            $this->certificate = $entity;
        }
        $this->price        = $price;
        $this->quantity     = $quantity;
        $this->image        = $image;
        $this->shopId       = $shopId;
        $this->deliveryId   = $deliveryId;
        $this->shopTariffId = $shopTariffId;
        $this->addressId    = $addressId;
        $this->pvz          = $pvz;
        $this->customer     = $customer;
    }

    public function certificate()
    {
        return $this->certificate;
    }

    public function customer()
    {
        return $this->customer;
    }

    public function id()
    {
        return $this->id;
    }

    public function option()
    {
        return $this->option;
    }

}
