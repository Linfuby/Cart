<?php
namespace Meling\Cart\Products;

abstract class Product
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var \Meling\Cart\Wrappers\Entity
     */
    protected $entity;

    /**
     * @var Points\Point[]
     */
    protected $points;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var \Meling\Cart\Wrappers\Entity
     */
    protected $shop;

    /**
     * @var \Meling\Cart\Wrappers\Entity
     */
    protected $delivery;

    /**
     * @var \Meling\Cart\Wrappers\Entity
     */
    protected $shopTariff;

    /**
     * @var \Meling\Cart\Wrappers\Entity
     */
    protected $address;

    /**
     * @var string
     */
    protected $pvz;

    /**
     * @var \Meling\Cart\Customer
     */
    protected $customer;

    /**
     * Product constructor.
     * @param int                          $id
     * @param \Meling\Cart\Wrappers\Entity $entity
     * @param float                        $price
     * @param int                          $quantity
     * @param string                       $image
     * @param \Meling\Cart\Wrappers\Entity $shop
     * @param \Meling\Cart\Wrappers\Entity $delivery
     * @param \Meling\Cart\Wrappers\Entity $shopTariff
     * @param \Meling\Cart\Wrappers\Entity $address
     * @param string                       $pvz
     * @param \Meling\Cart\Customer        $customer
     */
    public function __construct($id, $entity, $price, $quantity, $image, \Meling\Cart\Customer $customer, $shop = null, $delivery = null, $shopTariff = null, $address = null, $pvz = null)
    {
        $this->id         = $id;
        $this->entity     = $entity;
        $this->price      = $price;
        $this->quantity   = $quantity;
        $this->image      = $image;
        $this->shop       = $shop;
        $this->delivery   = $delivery;
        $this->shopTariff = $shopTariff;
        $this->address    = $address;
        $this->pvz        = $pvz;
        $this->customer   = $customer;
    }

    public function __call($method, $params)
    {
        return $this->entity->__call($method, $params);
    }

    public function __get($name)
    {
        return $this->entity->__get($name);
    }

    public function id()
    {
        return $this->id;
    }

    public abstract function points();

}
