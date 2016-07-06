<?php
namespace Meling\Cart\Products;

/**
 * Class Product
 * @package Meling\Cart\Products
 */
abstract class Product
{
    /** @var \Meling\Cart\Providers\Products\Product */
    protected $provider;
    /** @var \PHPixie\ORM\Drivers\Driver\PDO\Entity */
    protected $entity;
    /** @var mixed */
    private $addressId;
    /** @var mixed */
    private $cityId;
    /** @var int */
    private $price;
    /** @var string */
    private $pvz;
    /** @var int */
    private $quantity;
    /** @var mixed */
    private $shopId;
    /** @var mixed */
    private $shopTariffId;

    /**
     * Product constructor.
     *
     * @param \Meling\Cart\Providers\Products\Product $provider
     * @param \PHPixie\ORM\Models\Model\Entity  $entity
     * @param int                                     $quantity
     * @param int                                     $price
     * @param mixed                                   $shopId
     * @param mixed                                   $shopTariffId
     * @param mixed                                   $cityId
     * @param mixed                                   $addressId
     * @param string                                  $pvz
     */
    public function __construct(
        $provider,
        $entity,
        $quantity,
        $price,
        $shopId = null,
        $shopTariffId = null,
        $cityId = null,
        $addressId = null,
        $pvz = ''
    )
    {
        $this->provider     = $provider;
        $this->entity       = $entity;
        $this->quantity     = $quantity;
        $this->price        = $price;
        $this->shopId       = $shopId;
        $this->shopTariffId = $shopTariffId;
        $this->cityId       = $cityId;
        $this->addressId    = $addressId;
        $this->pvz          = $pvz;
    }

    public function quantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function addressId()
    {
        return $this->addressId;
    }

    /**
     * @return mixed
     */
    public function cityId()
    {
        return $this->cityId;
    }

    /**
     * @return int
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function pvz()
    {
        return $this->pvz;
    }

    /**
     * @return mixed
     */
    public function shopId()
    {
        return $this->shopId;
    }

    /**
     * @return mixed
     */
    public function shopTariffId()
    {
        return $this->shopTariffId;
    }

    /**
     * @return mixed
     */
    public function rests()
    {
        return $this->entity->{$this->provider->relationShip('rest')}();
    }

}

