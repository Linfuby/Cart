<?php
namespace Meling\Cart\Totals;

class Amount
{
    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    protected $total;

    /**
     * Amount constructor.
     * @param \Meling\Cart\Products $products
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    public function name()
    {
        return 'Сумма';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
            foreach($this->products->asArray() as $product) {
                $this->total += $product->priceTotal();
            }
        }

        return $this->total;
    }

}
