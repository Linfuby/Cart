<?php
namespace Meling\Cart\Totals;

class Amount
{
    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    protected $total;

    /**
     * Amount constructor.
     * @param \Meling\Cart\Products\Product[] $products
     */
    public function __construct(array $products)
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
            foreach($this->products as $product) {
                $this->total += $product->priceTotal();
            }
        }

        return $this->total;
    }

}
