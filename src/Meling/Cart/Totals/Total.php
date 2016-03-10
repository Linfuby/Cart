<?php
namespace Meling\Cart\Totals;

class Total extends ExtendedTotal
{
    public function add($priceTotal, $discountAction, $percent = true)
    {
        if($percent) {
            $this->total += round($priceTotal / 100 * $discountAction, 0, PHP_ROUND_HALF_DOWN);
        } else {
            $this->total += round($discountAction, 0, PHP_ROUND_HALF_DOWN);
        }
    }

    public function name()
    {
        return 'Итого:';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = $this->totals->amount()->total() + $this->totals->shipping()->total(
                ) - ($this->totals->action()->total() + $this->totals->card()->total());
        }

        return $this->total;
    }

}
