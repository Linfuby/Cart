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
     * @var Points\Shops
     */
    private $shops;

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

    /**
     * @param mixed $productId
     * @return Points\Tariffs\Deliveries
     */
    public function deliveries($productId = null)
    {
        if($this->deliveries === null) {
            $this->deliveries = $this->tariffs($productId)->deliveries();
        }

        return $this->deliveries;
    }

    /**
     * @param mixed $productId
     * @return Points\Shops
     */
    public function shops($productId = null)
    {
        if($this->shops === null) {
            $this->shops = $this->buildShops($productId);
        }

        return $this->shops;
    }

    /**
     * @param mixed $productId
     * @return Points\Tariffs
     * @throws \Exception
     */
    public function tariffs($productId = null)
    {
        if($this->tariffs === null) {
            if($productId === null) {
                $products = $this->products->asArray();
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

    private function buildShops($productId)
    {
        return new Points\Shops($this->products, $productId);
    }

}
