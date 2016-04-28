<?php
namespace Meling\Cart;

/**
 * Class Points
 * @package Meling\Cart
 */
class Points
{
    /**
     * @var Products
     */
    protected $products;

    /**
     * @var Points\Tariffs\Deliveries
     */
    private $deliveries;

    /**
     * @var Points\Tariffs
     */
    private $tariffs;

    /**
     * Points constructor.
     * @param Products $products
     */
    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function deliveries($productId = null)
    {
        if($this->deliveries === null) {
            $this->deliveries = $this->tariffs($productId)->deliveries();
        }

        return $this->deliveries;
    }

    public function tariffs($productId = null)
    {
        if($this->tariffs === null) {
            if($productId === null) {
                $products = $this->products;
            } else {
                $products = array($this->products->get($productId));
            }
            $this->tariffs = $this->buildTariffs($products);
        }

        return $this->tariffs;
    }

    protected function buildTariffs($products)
    {
        return new Points\Tariffs($products);
    }

}
