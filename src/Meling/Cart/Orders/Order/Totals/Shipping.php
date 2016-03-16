<?php
namespace Meling\Cart\Orders\Order\Totals;

class Shipping extends ExtendedTotal
{
    public function name()
    {
        return 'Доставка:';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
        }

        return $this->total;
    }

}
