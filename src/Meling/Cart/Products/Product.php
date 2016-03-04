<?php
namespace Meling\Cart\Products;

class Product
{
    /**
     * Product constructor.
     * @param int   $id
     * @param mixed $productCart
     */
    public function __construct($id, $productCart)
    {
        $this->id           = $id;
        $this->customerId   = empty($productCart->customerId) ? null : $productCart->customerId;
        $this->optionId     = empty($productCart->optionId) ? null : $productCart->optionId;
        $this->shopId       = empty($productCart->shopId) ? null : $productCart->shopId;
        $this->deliveryId   = empty($productCart->deliveryId) ? null : $productCart->deliveryId;
        $this->shopTariffId = empty($productCart->shopTariffId) ? null : $productCart->shopTariffId;
        $this->addressId    = empty($productCart->addressId) ? null : $productCart->addressId;
        $this->pvz          = empty($productCart->pvz) ? null : $productCart->pvz;
        $this->price        = empty($productCart->price) ? null : $productCart->price;
        $this->old_price    = !empty($productCart->old_price) && $productCart->special ? $productCart->old_price : null;
        $this->quantity     = empty($productCart->quantity) ? null : $productCart->quantity;
        $this->priceFinal   = $this->price();
    }

    /**
     * @return int
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function priceFinal()
    {
        return (int)($this->priceFinal);
    }

    /**
     * @return int
     */
    public function priceTotal()
    {
        return (int)($this->price * $this->quantity());
    }

    public function priceTotalFinal()
    {
        return (int)($this->priceFinal() * $this->quantity());
    }

    /**
     * @return int
     */
    public function priceTotalOld()
    {
        return (int)($this->old_price * $this->quantity());
    }

    /**
     * @return int
     */
    public function quantity()
    {
        return $this->quantity;
    }

}
