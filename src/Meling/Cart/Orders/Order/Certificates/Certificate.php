<?php
namespace Meling\Cart\Orders\Order\Certificates;

/**
 * Class Certificate
 * @package Meling\Cart\Orders\Order\Certificates
 */
class Certificate
{
    public    $addressId;

    public    $deliveryId;

    public    $price;

    public    $pvz;

    public    $shopId;

    public    $shopTariffId;

    protected $id;

    protected $entity;

    protected $quantity;

    protected $image;

    /**
     * Certificate constructor.
     * @param int                                    $id
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $certificate
     * @param string                                 $image
     * @param int                                    $price
     * @param int                                    $quantity
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $shop
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $tariff
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $address
     * @param string                                 $pvz
     */
    public function __construct(
        $id,
        $certificate,
        $image,
        $price = 0,
        $quantity = 1,
        $shop = null,
        $tariff = null,
        $address = null,
        $pvz = null)
    {
        $this->id         = $id;
        $this->entity     = $certificate;
        $this->image      = $image;
        $this->price      = $price;
        $this->quantity   = $quantity;
        $this->priceTotal = (int)$this->price * (int)$this->quantity;
        $this->priceFinal = $this->priceTotal;
        $this->shop       = $shop;
        if($shop) {
            $this->shopId = $shop->id();
        }
        $this->tariff = $tariff;
        if($tariff) {
            $this->shopTariffId = $tariff->id();
            $this->deliveryId   = $tariff->delivery()->id();
        }
        $this->address = $address;
        if($address) {
            $this->addressId = $address->id();
        }
        $this->pvz = $pvz;
    }

    function __call($name, $arguments)
    {
        return $this->entity->{$name}($arguments);
    }

    public function __get($name)
    {
        return $this->entity->{$name};
    }

    public function certificate()
    {
        return $this->entity;
    }

    public function id()
    {
        return $this->id;
    }

    public function image()
    {
        return $this->image;
    }

    public function quantity()
    {
        return $this->quantity;
    }

}
