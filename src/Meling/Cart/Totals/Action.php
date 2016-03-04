<?php
namespace Meling\Cart\Totals;

class Action extends ExtendedTotal
{
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