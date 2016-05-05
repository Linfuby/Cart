<?php
namespace Meling\Cart\Totals;

class Shipping
{
    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    /**
     * @var \Meling\Cart\Points
     */
    private $points;

    /**
     * @var int
     */
    private $total;


    /**
     * Shipping constructor.
     * @param \Meling\Cart\Points             $points
     * @param \Meling\Cart\Products\Product[] $products
     */
    public function __construct(\Meling\Cart\Points $points, array $products)
    {
        $this->products = $products;
        $this->points   = $points;
    }

    public function name()
    {
        return 'Доставка:';
    }

    public function set($total)
    {
        $this->total = $total;
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
            $points      = array();
            foreach($this->products as $productId => $product) {
                try {
                    if($point = $this->points->getFor($productId)->point()) {
                        $points[$product->pvz] = $point;
                    }
                } catch(\Exception $e) {
                    $product->shopId       = null;
                    $product->deliveryId   = null;
                    $product->shopTariffId = null;
                    $product->addressId    = null;
                    $product->pvz          = null;
                }
            }
            foreach($points as $point) {
                $this->total += $point->cost;
            }
        }

        return $this->total;
    }

}
