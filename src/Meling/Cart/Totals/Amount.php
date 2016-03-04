<?php
namespace Meling\Cart\Totals;

class Amount extends ExtendedTotal
{

    public function name()
    {
        return 'Сумма:';
    }

    public function total()
    {
        if($this->total === null) {
            foreach($this->products() as $product) {
                $this->total += $product->priceTotal();
            }
        }

        return $this->total;
    }

}