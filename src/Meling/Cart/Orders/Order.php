<?php
namespace Meling\Cart\Orders;

class Order
{
    protected $id;

    protected $name;

    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    /**
     * @var \Meling\Cart\Totals
     */
    protected $totals;

    /**
     * Order constructor.
     * @param                                 $id
     * @param                                 $name
     * @param \Meling\Cart\Products\Product[] $products
     * @param \Meling\Cart\Totals             $totals
     */
    public function __construct($id, $name, array $products, \Meling\Cart\Totals $totals)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->products = $products;
        $this->totals   = $totals;
    }

    public function addressId()
    {
        return $this->product()->addressId;
    }

    public function deliveryId()
    {
        return $this->product()->deliveryId;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function payments()
    {
        return array();
    }

    public function point()
    {
        return $this->totals()->points()->getFor(0);
    }

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public function products()
    {
        return $this->products;
    }

    public function pvz()
    {
        return $this->product()->pvz;
    }

    /**
     * @return \Parishop\ORMWrappers\Shop\Entity
     */
    public function shop()
    {
        return $this->point()->shops()->get($this->shopId())->shop;
    }

    public function shopId()
    {
        return $this->product()->shopId;
    }

    public function shopTariffId()
    {
        return $this->product()->shopTariffId;
    }

    public function totals()
    {
        return $this->totals;
    }

    /**
     * @return \Meling\Cart\Products\Product
     */
    protected function product()
    {
        return current($this->products());
    }

}
