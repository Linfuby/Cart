<?php
namespace Meling\Cart\Points;

/**
 * Точка отправления
 * Class Point
 * @package Meling\Cart\Points
 */
class Point
{
    /**
     * @var \Meling\Cart\Products\Product
     */
    protected $product;

    /**
     * @var Shops
     */
    protected $shops;

    /**
     * @var Deliveries
     */
    protected $deliveries;

    /**
     * Point constructor.
     * @param \Meling\Cart\Products\Product $product
     * @param Shops                         $shops
     * @param Deliveries                    $deliveries
     * @throws \Exception
     */
    public function __construct($product, $shops, $deliveries)
    {
        $this->product    = $product;
        $this->shops      = $shops;
        $this->deliveries = $deliveries;
    }

    /**
     * @return Deliveries
     */
    public function deliveries()
    {
        return $this->deliveries;
    }

    /**
     * @return object
     * @throws \Exception
     */
    public function point()
    {
        if($this->product->deliveryId) {
            return $this->deliveries()->get($this->product->deliveryId);
        }
        if($this->product->shopId) {
            return $this->shops()->get($this->product->shopId);
        }

        return null;
    }

    /**
     * @return Shops
     */
    public function shops()
    {
        return $this->shops;
    }

}
