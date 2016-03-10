<?php
namespace Meling\Cart\Totals;

class Action extends ExtendedTotal
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
        return 'Скидка по Акции:';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
        }

        return $this->total;
    }

}
