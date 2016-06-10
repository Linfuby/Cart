<?php
namespace Meling\Cart\Totals;

class Shipping
{
    /**
     * @var Amount
     */
    protected $amount;

    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    /**
     * @var int
     */
    protected $total;

    /**
     * Shipping constructor.
     * @param Amount                $amount
     * @param \Meling\Cart\Products $products
     */
    public function __construct(Amount $amount, $products)
    {
        $this->amount   = $amount;
        $this->products = $products;
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
            if($this->amount->total() < 10000) {
                /** @var \Meling\Cart\Points\Point[] $points */
                $points = array();
                foreach($this->products->asArray() as $product) {
                    if($product->point()) {
                        $points[$product->point()->id()] = $product->point();
                    }
                }
                foreach($points as $point) {
                    $this->total += $point->cost();
                }
            }
        }

        return $this->total;
    }

}
