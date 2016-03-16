<?php
namespace Meling\Cart\Orders\Order\Totals;

class Bonuses extends ExtendedTotal
{
    public function add($priceTotal, $discountAction, $percent = true)
    {
        if($percent) {
            $this->total += round($priceTotal / 100 * $discountAction);
        } else {
            $this->total += $discountAction;
        }
    }

    public function name()
    {
        return 'Начислено бонусов:';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
        }

        return $this->total;
    }

}
