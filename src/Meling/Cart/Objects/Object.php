<?php
namespace Meling\Cart\Objects;

abstract class Object
{
    /**
     * @var mixed
     */
    protected $addressId;

    /**
     * @var mixed
     */
    protected $deliveryId;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $entity;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var mixed
     */
    protected $shopId;

    /**
     * @var mixed
     */
    protected $shopTariffId;

    /**
     * Object constructor.
     * @param mixed                                      $id
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $entity
     * @param int                                        $price
     * @param int                                        $quantity
     * @param mixed                                      $shopId
     * @param mixed                                      $deliveryId
     * @param mixed                                      $shopTariffId
     * @param mixed                                      $addressId
     */
    public function __construct(
        $id,
        $entity,
        $price,
        $quantity = 1,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null)
    {
        $this->id           = $id;
        $this->entity       = $entity;
        $this->price        = (int)$price;
        $this->quantity     = (int)$quantity;
        $this->shopId       = $shopId;
        $this->deliveryId   = $deliveryId;
        $this->shopTariffId = $shopTariffId;
        $this->addressId    = $addressId;
    }

    public function addressId()
    {
        return $this->addressId;
    }

    public function deliveryId()
    {
        return $this->deliveryId;
    }

    public function entity()
    {
        return $this->entity;
    }

    public function id()
    {
        return $this->id;
    }

    public function price()
    {
        return $this->price;
    }

    public function quantity()
    {
        return $this->quantity;
    }

    public function shopId()
    {
        return $this->shopId;
    }

    public function shopTariffId()
    {
        return $this->shopTariffId;
    }
}
