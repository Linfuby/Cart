<?php
namespace Meling\Cart\Totals;

class Total extends ExtendedTotal
{
    public function name()
    {
        return 'Итого:';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = $this->totals->amount()->total() + $this->totals->shipping()->total(
                ) - ($this->totals->actions()->total() + $this->totals->card()->total());
        }

        return $this->total;
    }

}