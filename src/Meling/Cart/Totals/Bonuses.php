<?php
namespace Meling\Cart\Totals;

class Bonuses extends ExtendedTotal
{
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